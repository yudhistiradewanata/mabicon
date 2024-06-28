<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnnouncementController extends MY_Controller
{
    public function index()
    {
        $announcements = $this->announcementModel->getAnnouncements();

        $data = [
            'announcements' => $announcements
        ];

        $content = $this->load->view('admin/announcement/index', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Announcements']);
    }

    public function create()
    {
        if (getRequestMethod() == 'post') {
            $data = [
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'image' => $this->input->getFile('image')->store()
            ];

            if ($this->announcementModel->createAnnouncement($data)) {
                $this->session->set_flashdata('success', 'Announcement created successfully.');redirect('admin/announcement');
            } else {
                $this->session->set_flashdata('error', 'Failed to create announcement. Please try again.');redirect($this->input->server('HTTP_REFERER'));
            }
        }

        $content = $this->load->view('admin/announcement/create', true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Create Announcement']);
    }

    public function edit($id)
    {
        $announcement = $this->announcementModel->find($id);

        if (!$announcement) {
            $this->session->set_flashdata('error', 'Announcement not found.');redirect('admin/announcement');
        }

        if (getRequestMethod() == 'post') {
            $data = [
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content')
            ];

            if ($this->input->getFile('image')->isValid()) {
                $data['image'] = $this->input->getFile('image')->store();
            }

            if ($this->announcementModel->editAnnouncement($id, $data)) {
                return
