<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options
    )
    {
        //
    }

    public function optionsWithLable(): array{ //các tùy chọn có nhãn
        //array_is_list: là một mảng danh sách tuần tự
        // nếu không phải aray_is_list thì dùng 
        //array_combine tạo mảng mới sử dụng $this->options almf cả khóa và giá trị của mảng
        return array_is_list($this->options) ? array_combine($this->options, $this->options) : $this->options; 
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-group');
    }
}
