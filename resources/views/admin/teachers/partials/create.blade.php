<x-modal.modal id="Modalcreate" title="Create New Teacher" class="rounded-xl w-full max-w-4xl"
    svgPath="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
    <form action="{{ route('admin.teachers.store') }}" method="POST" class="py-4 needs-validation"
        enctype="multipart/form-data" novalidate>
        @csrf

        <div class="h-[65vh] md:h-[75vh] overflow-y-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                <x-upload-file />
                <x-cvupload />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-2 mb-2">
                <!-- Personal Information -->
                <x-fields.input label="Full Name" name="name" placeholder="Enter full name" maxlength="255"
                    :required="true" />
                <!-- Gender Select (Non-searchable) -->
                <x-fields.select name="gender" label="Gender" :required="true" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')" />

                <x-fields.input type="date" label="Date of Birth" name="date_of_birth"
                    placeholder="Enter Date of Birth" :required="true" max="{{ date('Y-m-d') }}"
                    value="{{ date('Y-m-d') }}" />
                <!-- Email Field -->
                <x-fields.input label="Email Address" type="email" name="email"
                    placeholder="Enter email: example@gmail.com" required
                    pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" />
                <x-fields.input type="tel" label="Phone" name="phone"
                    placeholder="+855 889820067 or +855 889 820 067" :required="true" max="20" maxlength="20"
                    pattern="^(?:\+855|0)\s?\d{2,3}\s?\d{3}\s?\d{3}$" />
                <x-fields.input type="date" label="Joining Date" name="joining_date" placeholder="Enter joining date"
                    :required="true" value="{{ date('Y-m-d') }}" />

                <x-fields.input label="Qualification" name="qualification" placeholder="Enter qualification"
                    :required="true" />
                <x-fields.input type="text" min="0" max="60" maxlength="2" label="Experience"
                    name="experience" placeholder="Enter number 0-60" pattern="^([0-9]|[1-5][0-9]|60)$"
                    title="Enter a number between 0 and 60" :required="true"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                <x-fields.input label="Specialization" name="specialization" placeholder="Enter specialization" />
                <x-fields.input type="text" label="Salary" name="salary" placeholder="Enter salary 0$-9999$" maxlength="5" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g,''); 
             let parts = this.value.split('.'); 
             if(parts.length > 1){ this.value = parts[0]+'.'+parts[1]; } 
             else { this.value = parts[0]+(parts[1]?'.'+parts[1].slice(0,1):''); }"/>
            </div>
            <x-fields.input label="Address" name="address" placeholder="Enter address" required maxlength="500" />
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :create="true" class="pb-0"/>
    </form>
</x-modal.modal>
