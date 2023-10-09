{{-- lấy các thuộc tính tailwindcss ở layout và card --}}
<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs'=>route('jobs.index')]"/>

    <x-card class="mb-4 text-sm" x-data="">
        <form x-ref="filters" id="filtering-form" action="{{ route('jobs.index') }}" method="get">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" value="{{ request('search') }}" placeholder="Seach for any text" form-ref="filters" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="From" form-ref="filters" />
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To" form-ref="filters" />
                    </div>
                </div>  
                <div>
                    <div class="mb-1 font-semibold">Experience</div>
                    {{-- array_combine tạo mảng mới sử dụng \App\Models\Job::$experience làm cả khóa và giá trị của mảng, 
                        và array_map sử dụng ucfirst để in hoa chữ đầu mỗi khóa mảng 
                    VD: array_combine(array_map('ucfirst',['true','false']),['true','false']);
                                        array(2) {
                                        ["True"]=>
                                        string(4) "true"
                                        ["False"]=>
                                        string(5) "false"
                                        }
                    --}}
                    <x-radio-group name="experience" :options=" array_combine(array_map('ucfirst',\App\Models\Job::$experience), \App\Models\Job::$experience) " />  
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-group name="category" :options="\App\Models\Job::$category" />  
                </div>
            </div>
            <x-button class="w-full">Filter</x-button>
        </form>
    </x-card>
    @foreach ($jobs as $job)
{{--  để sử dụng $job thì ta dùng  :job="$job"  nhưng nếu tên biến cùng tên với thuộc tính thì chỉ cần :$job --}}
    <x-job-card :$job>
        <div>
            <x-link-button :href="route('jobs.show', $job)">
                Show
            </x-link-button>
        </div>
    </x-job-card>        
    @endforeach
</x-layout>