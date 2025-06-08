<div id="deleteFolder" class="hidden justify-center items-center fixed inset-0 z-50">
  <!-- Modal Overlay -->
  <div
    class="fixed inset-0 px-2 z-10 overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-50 transition-opacity"></div>

    <!-- Modal Content -->
    <div
      class="bg-white rounded-none shadow-xl overflow-hidden max-w-2xl w-full sm:w-96 md:w-1/2 lg:w-2/3 xl:w-1/4 z-50">
      <!-- Modal Header -->
      <div class="bg-black text-white px-4 py-2 flex justify-between">
        <h2 class="text-lg font-semibold justify-start">DELETE FOLDER</h2>
        <button id="closeDeleteModal">
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
        <p>Are you sure you want to delete this folder?</p>

      </div>
      <!-- Modal Footer -->
      <div class="border-t border-gray-400 px-4 py-2 flex justify-center">
        <button
          id="confirmDeleteFolder"
          class="px-3 py-1 bg-black text-white border-2 border-black hover:bg-white hover:text-black rounded-md w-full sm:w-auto">
          DELETE
        </button>
      </div>
    </div>
  </div>
</div>