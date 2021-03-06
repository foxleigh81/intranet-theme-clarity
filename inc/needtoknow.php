<?php

namespace MOJ\Intranet;

if (!defined('ABSPATH')) die();

class NeedToKnow {

    private $max_need_to_know_news;

    public function __construct() {
        $this->max_need_to_know_news = 3;
    }

    public function getNeedToKnow($options = array()) {
        $agency = $options['agency'] ?: 'hq';
        $prefix = $agency . '_';
        $options = $this->normalize_need_to_know_options($options);

        for($a = $options['start']; $a <= $options['length']; $a++) {
            $slide['title'] = get_option($prefix . 'need_to_know_headline' . $a) ?: '';
            $slide['url'] = get_option($prefix . 'need_to_know_url' . $a) ?: '';
            $slide['image_url'] = $this->get_correct_image(get_option($prefix . 'need_to_know_image' . $a)) ?: '';
            $slide['image_alt'] = get_option($prefix . 'need_to_know_alt' . $a) ?: '';
            $data[] = $slide;
        }

        return $data;
    }

    private function normalize_need_to_know_options($options) {
        $default = array(
            'start' => 1,
            'length' => $this->max_need_to_know_news
        );

        foreach($options as $key=>$value) {
            if($value) {
                if($key == 'length' && $value > $this->max_need_to_know_news) {
                    $default[$key] = $this->max_need_to_know_news;
                } else {
                    $default[$key] = $value;
                }
            }
        }

        return $default;
    }

    private function get_correct_image($url) {
        $url = preg_replace('#https?://([^/]+.amazonaws.com/[^/]+|[^/]+)#', site_url(), $url);
        $attachment_id = get_attachment_id_from_url($url);
        $thumbnail = wp_get_attachment_image_src($attachment_id, 'need-to-know');
        return $thumbnail[0];
    }

}