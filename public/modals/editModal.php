<div id="editFolder" class="hidden justify-center items-center fixed inset-0 z-50">
  <!-- Modal Overlay -->
  <div
    class="fixed inset-0 px-2 z-10 overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-50 transition-opacity"></div>

    <!-- Modal Content -->
    <div
      class="bg-white rounded-none shadow-xl overflow-hidden max-w-2xl w-full sm:w-96 md:w-1/2 lg:w-2/3 xl:w-4/5 z-50">
      <!-- Modal Header -->
      <div class="bg-black text-white px-4 py-2 flex justify-between">
        <h2 class="text-lg font-semibold justify-start">EDIT FOLDER</h2>
        <button id="closeEditModal">
          <div class="justify-end">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="white"
              class="size-6">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18 18 6M6 6l12 12" />
            </svg>
          </div>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="p-4">
        <form class="space-y-4">
          <!-- Name Fields Row -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-bold text-black">First Name<span class="text-red-500">*</span></label>
              <input
                type="text"
                id="firstNameEdit"
                name="firstName"
                placeholder="e.g. Juan"
                class="mt-1 block w-full border border-black rounded-none px-2 py-1" />
            </div>
            <div>
              <label class="block text-sm font-bold text-black">Middle Name</label>
              <input
                type="text"
                id="middleNameEdit"
                name="middleName"
                placeholder="e.g. Rose"
                class="mt-1 block w-full border border-black rounded-none px-2 py-1" />
            </div>
            <div>
              <label class="block text-sm font-bold text-black">Last Name<span class="text-red-500">*</span></label>
              <input
                type="text"
                id="lastNameEdit"
                name="lastName"
                placeholder="e.g. Dela Cruz"
                class="mt-1 block w-full border border-black rounded-none px-2 py-1" />
            </div>
          </div>

          <!-- Student Info Row -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-bold text-black">Student Number<span class="text-red-500">*</span></label>
              <input
                type="text"
                id="studentNumberEdit"
                name="studentNumber"
                placeholder="e.g. 2xxx-x-xxxx"
                class="mt-1 block w-full border border-black rounded-none px-2 py-1" />
            </div>
            <div>
              <label class="block text-sm font-bold text-black">Year<span class="text-red-500">*</span></label>
              <select
                id="yearOptionEdit"
                name="yearOption"
                class="mt-1 block w-full border border-black rounded-none px-2 py-1">
                <option value="1">First Year</option>
                <option value="2">Second Year</option>
                <option value="3">Third Year</option>
                <option value="4">Fourth Year</option>
                <option value="0">Irregular</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-bold text-black">Status<span class="text-red-500">*</span></label>
              <select
                id="statusOptionEdit"
                name="statusOption"
                class="mt-1 block w-full border border-black rounded-none px-2 py-1">
                <option value="1">OFFICE</option>
                <option value="2">ENCODING</option>
              </select>
            </div>
          </div>
        </form>
      </div>

      <!-- Modal Footer -->
      <div class="border-t border-gray-400 px-4 py-2 flex justify-end gap-3">
        <button
          class="px-3 py-1 bg-black text-white border-2 border-black hover:bg-white hover:text-black rounded-md w-full sm:w-auto">
          ARCHIVE
        </button>
        <button
          id="updateChanges"
          class="px-3 py-1 bg-black text-white border-2 border-black hover:bg-white hover:text-black rounded-md w-full sm:w-auto">
          UPDATE
        </button>
      </div>
    </div>
  </div>
</div>