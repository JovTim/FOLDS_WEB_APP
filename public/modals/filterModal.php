<div
  id="filterModal"
  class="hidden justify-center items-center fixed inset-0 z-50">
  <!-- Modal Overlay -->
  <div
    class="fixed inset-0 px-2 z-10 overflow-hidden flex items-center justify-center">
    <div
      class="absolute inset-0 bg-black opacity-50 transition-opacity"></div>

    <!-- Modal Content -->
    <div
      class="bg-white rounded-none shadow-xl overflow-hidden w-full sm:w-96 md:w-1/2 lg:w-2/3 xl:w-55 z-50">
      <!-- Modal Header -->
      <div class="bg-black text-white px-4 py-2 flex justify-between">
        <h2 class="text-lg font-semibold justify-start">FILTER</h2>
        <button id="closeFilterModal" class="cursor-pointer">
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
      <div class="px-2">
        <div class="border-b border-black pb-1">
          <h1 class="font-bold pb-2">YEAR</h1>
          <div class="grid grid-cols-2">
            <div class="flex items-center mb-4">
              <input
                type="checkbox"
                value="1"
                class="w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black"
                checked />
              <label class="ms-2 text-sm font-medium text-gray-900">Year 1</label>
            </div>
            <div class="flex items-center mb-4">
              <input
                type="checkbox"
                value="2"
                class="w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black"
                checked />
              <label class="ms-2 text-sm font-medium text-gray-900">Year 2</label>
            </div>
            <div class="flex items-center mb-4">
              <input
                type="checkbox"
                value="3"
                class="w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black"
                checked />
              <label class="ms-2 text-sm font-medium text-gray-900">Year 3</label>
            </div>
            <div class="flex items-center mb-4">
              <input
                type="checkbox"
                value="4"
                class="w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black"
                checked />
              <label class="ms-2 text-sm font-medium text-gray-900">Year 4</label>
            </div>
            <div class="flex items-center mb-4">
              <input
                type="checkbox"
                value="0"
                class="w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black"
                checked />
              <label class="ms-2 text-sm font-medium text-gray-900">Irregular</label>
            </div>
          </div>
        </div>
        <div class="border-b border-black pb-1">
          <h1 class="font-bold pb-2">STATUS</h1>
          <div class="grid grid-cols-2">
            <div class="flex items-center mb-4">
              <input
                type="radio"
                value="All"
                name="status"
                class="status-filter w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black"
                checked />
              <label class="ms-2 text-sm font-medium text-gray-900">All</label>
            </div>
            <div class="flex items-center mb-4">
              <input
                type="radio"
                value="Office"
                name="status"
                class="status-filter w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black" />
              <label class="ms-2 text-sm font-medium text-gray-900">Office</label>
            </div>
            <div class="flex items-center mb-4">
              <input
                type="radio"
                value="Encoding"
                name="status"
                class="status-filter w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black" />
              <label class="ms-2 text-sm font-medium text-gray-900">Encoding</label>
            </div>
          </div>
        </div>
        <div class="pb-1">
          <h1 class="font-bold pb-2">FOLDERS</h1>
          <div class="grid grid-cols-2">
            <div class="flex items-center mb-4">
              <input
                type="radio"
                value="All"
                name="folder"
                class="enroll-filter w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black" />
              <label class="ms-2 text-sm font-medium text-gray-900">All</label>
            </div>
            <div class="flex items-center mb-4">
              <input
                type="radio"
                value="1"
                name="folder"
                class="enroll-filter w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black" checked />
              <label class="ms-2 text-sm font-medium text-gray-900">Enrolled</label>
            </div>
            <div class="flex items-center mb-4">
              <input
                type="radio"
                value="2"
                name="folder"
                class="enroll-filter w-5 h-5 text-black accent-black border-black rounded-none focus:ring-black" />
              <label class="ms-2 text-sm font-medium text-gray-900">Archived</label>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="border-t border-gray-400 px-4 py-2 flex justify-end">
        <button
          id="applyFilter"
          class="px-3 py-1 bg-black text-white border-2 border-black hover:bg-white hover:text-black rounded-md w-full sm:w-auto cursor-pointer">
          APPLY
        </button>
      </div>
    </div>
  </div>
</div>