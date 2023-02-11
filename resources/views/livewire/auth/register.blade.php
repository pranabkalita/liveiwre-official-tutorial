<div>
    <form class="space-y-6" wire:submit.prevent="register">
        <div class="rounded-md shadow-sm">
            <div>
                <label for="name">Name</label>
                <input wire:model.lazy="name" id="name" type="text"
                    class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
                    placeholder="Email address">

                @error('name')
                    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <label for="email-address">Email address</label>
                <input wire:model.lazy="email" id="email-address" type="text"
                    class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                    placeholder="Email address">

                @error('email')
                    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <label for="password">Password</label>
                <input wire:model.lazy="password" id="password" type="password"
                    class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm @error('password') border-red-500 @enderror"
                    placeholder="Password">

                @error('password')
                    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password_confirmation">Password Confirmation</label>
                <input wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password"
                    class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    placeholder="Password">
            </div>
        </div>

        <div class="space-y-2">
            <button type="submit"
                class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <!-- Heroicon name: mini/lock-closed -->
                    <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                Register
            </button>
        </div>
    </form>

    <div class="text-sm text-center">
        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
            Already have an account ?
        </a>
    </div>
</div>
