<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use SimplePie\SimplePie;

class NewsController extends MY_Controller
{
    private $rssUrl = 'https://www.forexlive.com/feed';

    public function index()
    {
        $newsItems = $this->fetchNews();

        $data = [
            'newsItems' => $newsItems
        ];

        $content = $this->load->view('member/news/index', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Forex News']);
    }

    public function view()
    {
        $guid=$this->input->get('guid');
        $newsItems = $this->fetchNews();
        $newsItem = null;

        // Find the news item with the specified GUID
        foreach ($newsItems as $item) {
            if ($item['guid'] == $guid) {
                $newsItem = $item;
                break;
            }
        }

        if (!$newsItem) {
            $this->session->set_flashdata('error', 'News item not found.');redirect('member/news');
        }

        $data = [
            'newsItem' => $newsItem
        ];

        $content = $this->load->view('member/news/view', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'News Detail']);
    }

    private function fetchNews()
    {
        $feed = new SimplePie();
        $feed->set_feed_url($this->rssUrl);
        $feed->enable_cache(false);
        $feed->init();

        $newsItems = [];
        foreach ($feed->get_items() as $item) {
            $newsItems[] = [
                'title' => $item->get_title(),
                'link' => $item->get_link(),
                'description' => $item->get_description(),
                'pubDate' => $item->get_date('Y-m-d H:i:s'),
                'guid' => $item->get_id(),
            ];
        }

        return $newsItems;
    }
}
