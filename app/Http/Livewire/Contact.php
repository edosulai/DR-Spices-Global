<?php

namespace App\Http\Livewire;

use App\Models\ContactUs;
use Livewire\Component;

class Contact extends Component
{
    public $address;
    public $phone;
    public $email;
    public $map;
    public $message;
    public $short;

    public $form = [];
    public $feedbackModal = false;

    protected $rules = [
        'form.name' => 'required|max:255',
        'form.email' => 'required|email|max:255',
        'form.subject' => 'required|min:3|max:255',
        'form.message' => 'required',
    ];

    protected $validationAttributes = [
        'form.name' => 'Name',
        'form.email' => 'Email',
        'form.subject' => 'Subject',
        'form.message' => 'Message',
    ];

    public function updated()
    {
        $this->validate($this->rules);
    }

    public function mount()
    {
        $this->address = 'Jl. Raya Bukittingi - Payakumbuh KM.13, Jorong Baso, Kab. Agam, Sumatera Barat, 26192';
        $this->phone = '+628-576-080-0434';
        $this->email = 'support@drspicesglobal.com';
        $this->map = 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7979.537927044466!2d100.4641711!3d-0.2849936!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd5482329548e17%3A0xc62357b3644ec3c7!2sPasar%20Baso!5e0!3m2!1sen!2sid!4v1656122013399!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade';
        $this->message = 'If you have any questions we will always be happy to help. Feel free to contact us by telephone or email and we will be sure to get back to you as soon as possible';
        $this->short = 'Get in touch with our customer support team';
    }

    public function send()
    {
        $this->validate();
        ContactUs::create([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'subject' => $this->form['subject'],
            'message' => $this->form['message'],
        ]);
        $this->feedbackModal = true;
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
