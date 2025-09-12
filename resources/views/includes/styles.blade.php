<style>
    /* --- base: buat select2 mirip input textarea --- */
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple,
    .select2-container .select2-selection--single,
    .select2-container .select2-selection--multiple {
        width: 100% !important;
        padding: 0.5rem 0.75rem !important;       /* px-3 py-2 */
        border: 1px solid #d1d5db !important;     /* border-gray-300 */
        border-radius: 0.5rem !important;         /* rounded-lg */
        font-size: 0.875rem !important;           /* text-sm */
        min-height: 42px !important;
        display: flex;
        align-items: center;
        background-color: #ffffff !important;
        transition: border-color .12s ease, box-shadow .12s ease;
    }

    /* --- focus: border & ring hitam --- */
    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default .select2-selection--single:focus,
    .select2-container--default .select2-selection--multiple:focus {
        border-color: #000 !important;                /* focus:border-black */
        outline: none !important;
    }

    /* --- text / placeholder --- */
    .select2-container--default .select2-selection__rendered {
        font-size: 0.875rem !important;
        line-height: 1.25rem !important;
        padding-left: 0 !important;
        padding-top: 3px !important;
    }
    
    /* multiple select placeholder & text center */
    .select2-container--default .select2-selection--multiple {
        font-size: 0.875rem !important;
        line-height: 1.25rem !important;
        padding-left: 5px !important;
        padding-top: 5px !important;
    }

    /* --- dropdown arrow --- */
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        right: 0.5rem !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 1em; /* ukuran panah */
        height: 1em;
    }

    /* ubah warna panah */
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: #111827 transparent transparent transparent !important;
    }

    /* --- clear icon --- */
    .select2-container--default .select2-selection__clear {
        color: #9ca3af !important;
    }
    .select2-container--default .select2-selection__clear:hover {
        color: #111827 !important;
    }

    /* --- dropdown options (ubah default biru ke hitam) --- */
    .select2-container--default .select2-results__option {
        font-size: 0.875rem !important;
        padding: 8px 12px !important;
        color: #374151 !important;
        background: transparent !important;
    }

    /* hovered / highlighted option -> hitam + putih */
    .select2-container--default .select2-results__option--highlighted,
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #111827 !important; /* hitam */
        color: #ffffff !important;             /* putih */
    }

    /* selected option in results */
    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #111827 !important;
        color: #ffffff !important;
    }

    /* --- tag chips style (multiple) --- */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #111827 !important; /* hitam */
        color: #ffffff !important;
        border: none !important;
        border-radius: 0.375rem !important;
        margin-top: 0.25rem !important;
        margin-right: 0.25rem !important;
    }

    /* tag remove (x) */
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: rgba(255,255,255,0.9) !important;
        margin-right: 6px !important;
    }

    /* hover remove tag */
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        background: none !important; /* hilangkan background putih */
    }

    /* ensure dropdown appears above other elements */
    .select2-container .select2-dropdown {
        z-index: 99999 !important;
    }

    /* remove focus color category input */
    .select2-search__field {
        outline: none;
        font-size: 0.875rem !important;
    }

    /* fallback: style the original select (in case JS belum jalan) */
    select.category-select,
    select.tags-select {
        border: 1px solid #d1d5db;
        border-radius: .5rem;
        padding: .5rem .75rem;
    }
</style>