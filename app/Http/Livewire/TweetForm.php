<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class TweetForm extends Component
{
    use WithFileUploads;

    public $body;
    public $image;

    public function render()
    {
        return view('livewire.tweet-form');
    }

    public function updatedBody()
    {
        $this->validate([
            'body' => 'max:255',
        ]);
    }

    public function submitForm()
    {
        $this->validate([
            'body' => 'required|max:255',
            'image' => 'nullable|image|max:1024', // Adjust the max file size as needed
        ]);

        // Your form submission logic goes here

        // Clear the input fields after submission
        $this->body = '';
        $this->image = null;

        // Show success message
        Session::flash('success', 'Tweet posted successfully!');
    }
}
