<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Help & Documentation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <div class="prose max-w-none">
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">{{ __('Getting Started') }}</h3>
                    <p class="mb-4">
                        {{ __('Welcome to the Laboratory Management System of the Faculty of Engineering, Mulawarman University. This platform helps you manage laboratory assets, schedule practicums, and report issues.') }}
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                        <div>
                            <h4 class="font-bold text-gray-700 mb-2">{{ __('For Students & Lecturers') }}</h4>
                            <ul class="list-disc list-inside space-y-2 text-gray-600">
                                <li>
                                    <strong>{{ __('Borrowing Items') }}:</strong> 
                                    {{ __('Go to the "Borrowings" menu, click "New Request", select dates and items, then submit. Wait for approval notification via email.') }}
                                </li>
                                <li>
                                    <strong>{{ __('Reporting Damage') }}:</strong> 
                                    {{ __('If you find a damaged item, go to "Damage Reports", click "Report New Damage", search for the item, and describe the issue.') }}
                                </li>
                                <li>
                                    <strong>{{ __('Checking Schedules') }}:</strong> 
                                    {{ __('View the "Schedules" menu to see upcoming practicums and room availability.') }}
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-700 mb-2">{{ __('For Lab Assistants & Admins') }}</h4>
                            <ul class="list-disc list-inside space-y-2 text-gray-600">
                                <li>
                                    <strong>{{ __('Approving Requests') }}:</strong> 
                                    {{ __('Check "Approvals" to review pending borrowing requests. Approve or reject them based on availability.') }}
                                </li>
                                <li>
                                    <strong>{{ __('Managing Inventory') }}:</strong> 
                                    {{ __('Use the "Inventory" menu to add, edit, or update the status of equipment.') }}
                                </li>
                                <li>
                                    <strong>{{ __('Handling Reports') }}:</strong> 
                                    {{ __('Review "Damage Reports", update the repair status, and log maintenance activities.') }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mt-8 mb-4">{{ __('Frequently Asked Questions') }}</h3>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-bold text-gray-700">{{ __('How do I know if my request is approved?') }}</h5>
                            <p class="text-gray-600">{{ __('You will receive an email notification, and the status in "My Borrowings" will change to "Approved".') }}</p>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-bold text-gray-700">{{ __('What if the item I need is not listed?') }}</h5>
                            <p class="text-gray-600">{{ __('Contact the Head of Laboratory or Lab Assistant to check if the item is available but not yet recorded in the system.') }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-bold text-gray-700">{{ __('Can I cancel a request?') }}</h5>
                            <p class="text-gray-600">{{ __('Currently, you can only cancel pending requests. If approved, please contact the admin.') }}</p>
                        </div>
                    </div>

                    <div class="mt-8 text-center text-sm text-gray-500">
                        <p>{{ __('For technical support, please contact the IT Unit.') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
