<?php

    add_action('rest_api_init', 'universityRegisterSearch');

    function universityRegisterSearch() {
        register_rest_route('university/v1', 'search', array(
            'methods' => WP_REST_SERVER::READABLE,
            'callback' => 'universitySearchResults'
        ));
    }

    function universitySearchResults($data) {
        $term = sanitize_text_field($data['term']);
        $searchQuery = new WP_Query(array(
            'post_type' => array('post', 'page', 'program', 'professor', 'event', 'campus'),
            's' => $term)
        );
 
        $searchResults = array(
            'generalInfo' => array(),
            'programs' => array(),
            'professors' => array(),
            'events' => array(),
            'campuses' => array()
        );

        while($searchQuery->have_posts()) {
            $searchQuery->the_post();
            
            if(get_post_type() == 'post' OR get_post_type() == 'page'){
                array_push($searchResults['generalInfo'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'postType' => get_post_type(),
                    'authorName' => get_the_author()
                ));
            }

            if(get_post_type() == 'program'){
                    $title = get_the_title();
                    if (!str_contains(strtolower($title), strtolower($term))) {
                        continue;
                    }
                        array_push($searchResults['programs'], array(
                            'title' => get_the_title(),
                            'permalink' => get_the_permalink(),
                            'id' => get_the_id()
                        ));                        
                    $relatedCampuses = get_field('related_campus');
                    if($relatedCampuses) {
                        foreach($relatedCampuses as $campus) {
                            array_push($searchResults['campuses'], array(
                                'title' => get_the_title($campus),
                                'permalink' => get_the_permalink($campus)
                            ));                      
                        }
                    }

            }      

            if(get_post_type() == 'professor'){
                array_push($searchResults['professors'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
                ));
            }
            
            if(get_post_type() == 'event'){
                $eventDate = new DateTime(get_field('event_date'));
                $summary = null;
                if (has_excerpt()) {
                    $summary = get_the_excerpt();
                } else {
                    $summary = wp_trim_words(get_the_content(), 11);
                }              

                array_push($searchResults['events'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'month' => $eventDate->format('M'),
                    'day' => $eventDate->format('d'),
                    'summary' => $summary
                ));
            }

            if(get_post_type() == 'campus'){
                array_push($searchResults['campuses'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink()
                ));
            } 

        }

        if ($searchResults['programs']) {
            $programsMetaQuery = array('relation' => 'OR');
        
            foreach($searchResults['programs'] as $item) {
              array_push($programsMetaQuery, array(
                  'key' => 'related_programs',
                  'compare' => 'LIKE',
                  'value' => '"' . $item['id'] . '"'
                ));
            }
        
            $programRelationshipQuery = new WP_Query(array(
              'post_type' => array('professor', 'event'),
              'meta_query' => $programsMetaQuery
            ));
        
            while($programRelationshipQuery->have_posts()) {
              $programRelationshipQuery->the_post();
        
              if (get_post_type() == 'professor') {
                array_push($searchResults['professors'], array(
                  'title' => get_the_title(),
                  'permalink' => get_the_permalink(),
                  'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
                ));
              }
              
              if(get_post_type() == 'event'){
                $eventDate = new DateTime(get_field('event_date'));
                $summary = null;
                if (has_excerpt()) {
                    $summary = get_the_excerpt();
                } else {
                    $summary = wp_trim_words(get_the_content(), 11);
                   
                }              

                array_push($searchResults['events'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'month' => $eventDate->format('M'),
                    'day' => $eventDate->format('d'),
                    'summary' => $summary
                    ));
                }
            }
        
            $searchResults['professors'] = array_values(array_unique($searchResults['professors'], SORT_REGULAR));
            $searchResults['events'] = array_values(array_unique($searchResults['events'], SORT_REGULAR));
            $searchResults['campuses'] = array_values(array_unique($searchResults['campuses'], SORT_REGULAR));
          }

        return $searchResults;
    }
    
