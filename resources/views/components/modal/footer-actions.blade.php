<div {{ $attributes->merge(['class' => 'flex justify-end space-x-3 p-4 border-t border-gray-200 dark:border-gray-700 ' . $class]) }}>
  @if ($create || $edit)
    <x-button.button btn-type="cancel" id="cancel">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
          clip-rule="evenodd" />
      </svg>
      Cancel
    </x-button.button>
  @endif
  @if ($create)
    <x-button.button btn-type="save" id="createSubmitBtn" type="submit">
      <span class="btn-content flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
            clip-rule="evenodd" />
        </svg>
        Create
      </span>
    </x-button.button>
  @endif

  @if ($edit)
    <x-button.button btn-type="save" id="saveEditBtn" type="submit">
      <span class="btn-content flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
            clip-rule="evenodd" />
        </svg>
        Save Change
      </span>
    </x-button.button>
  @endif

  @if ($detail)
    <button type="button" id="close"
      class="px-5 py-2.5 cursor-pointer bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
      Close
    </button>
  @endif

  @if ($delete)
    <button type="button" id="cancelDeleteModal"
      class="px-4 py-2 border cursor-pointer border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700">
      Cancel
    </button>
    <form id="Formdelete" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" id="confirmDeleteBtn"
        class="px-4 py-2 cursor-pointer bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
            clip-rule="evenodd" />
        </svg>
        Confirm
      </button>
    </form>
  @endif
</div>