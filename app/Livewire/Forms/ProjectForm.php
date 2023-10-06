<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class ProjectForm extends Form
{
    #[Rule('required|min:2|max:255', as: "عنوان پروژه")]
    public $title;

    #[Rule('required|min:2|max:255', as: "نام مشتری")]
    public $client;

    #[Rule('nullable|image|mimes:jpeg,png,jpg|max:4096', as: 'تصویر لوگوی پروژه')]
    public $logo;

    #[Rule('nullable|numeric|in:0,1,2', as: 'الویت پروژه')]
    public $priority = 0;

    #[Rule('required|regex:/^[0-9]+$/', as: 'مبلغ پروژه', onUpdate: false)]
    public $price;
    #[Rule('required', as: 'تاریخ مهلت')]
    public $end_date;

    #[Rule('required|numeric|exists:groups,id', as: 'گروه')]
    public $group_id;

    #[Rule('required|min:5', as: 'توضیحات پروژه')]
    public $description;

    public $images = [];

}
