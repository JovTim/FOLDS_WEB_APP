<div
      id="defaultModal"
      tabindex="-1"
      aria-hidden="true"
      class="fixed inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50 z-50 px-2"
    >
      <!-- Modal content -->
      <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl">
        <!-- Modal header -->
        <div
          class="flex justify-between items-center pb-4 mb-4 rounded-t border-b dark:border-gray-600"
        >
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Add Folder
          </h3>
          <button
            type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="defaultModal"
          >
            <svg
              aria-hidden="true"
              class="w-5 h-5"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
              ></path>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <form action="#">
          <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div>
              <label
                for="student_no"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Student Number<span class="text-red-500">*</span></label
              >
              <input
                type="text"
                name="student_no"
                id="student_no"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="ex. 2022-8-0211"
                required=""
              />
            </div>
            <div>
              <label
                for="f_name"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >First Name<span class="text-red-500">*</span></label
              >
              <input
                type="text"
                name="f_name"
                id="f_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="ex. Juan"
                required=""
              />
            </div>

            <div>
              <label
                for="m_name"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Middle Name</label
              >
              <input
                type="text"
                name="m_name"
                id="m_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="ex. Dela"
              />
            </div>

            <div>
              <label
                for="l_name"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Last Name<span class="text-red-500">*</span></label
              >
              <input
                type="text"
                name="l_name"
                id="l_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="ex. Cruz"
              />
            </div>

            <div>
              <label
                for="year"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Year<span class="text-red-500">*</span></label
              >
              <select
                id="year"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              >
                <option disabled selected hidden>Select Year</option>
                <option value="1">First Year</option>
                <option value="2">Second Year</option>
                <option value="3">Third Year</option>
                <option value="4">Fourth Year</option>
                <option value="0">Irregular</option>
              </select>
            </div>
          </div>
          <button
            type="submit"
            class="text-black bg-blue-500 inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
          >
            <svg
              class="mr-1 -ml-1 w-6 h-6"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd"
              ></path>
            </svg>
            Insert Folder
          </button>
        </form>
      </div>
    </div>