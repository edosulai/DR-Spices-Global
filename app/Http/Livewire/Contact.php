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
        $this->address = '123 Suspendis matti, Visaosang Building VST District NY Accums, North American';
        $this->phone = '+0012-345-67890';
        $this->email = 'support@domain.com';
        $this->map = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.3785754726428!2d105.78134315594316!3d21.01753304734255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454ab43c0c4db%3A0xdb6effebd6991106!2sKeangnam+Hanoi+Landmark+Tower!5e0!3m2!1svi!2s!4v1530175498947';
        $this->short = 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Proin gravida nibh vel velit auctor aliquet.';
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
