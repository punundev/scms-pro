$(document).ready(function () {
  const currentPath = window.location.pathname;
  const activeLink = localStorage.getItem('activeLink');

  // When user clicks any link
  $('.menu-item a').on('click', function(e) {
    localStorage.setItem('activeLink', this.href);
  });

  // Determine active link (based on saved localStorage OR currentPath)
  let targetLink = null;

  $('a').each(function() {
    const href = this.href;
    if (activeLink && href === activeLink) {
      targetLink = $(this);
    } else if (!activeLink && href.includes(currentPath)) {
      targetLink = $(this);
    }
  });

  if (targetLink && targetLink.length) {
    targetLink.addClass('bg-indigo-700 dark:bg-gray-700 text-white rounded-lg');

    // Open submenu if it exists
    const submenu = targetLink.closest('.submenu');
    if (submenu.length) {
      submenu.addClass('active').show();
      submenu.prev('.js-submenu-toggle').addClass('bg-indigo-700 dark:bg-gray-700');
    }
  }

    // Use event delegation for dropdowns
    $(document).on('click', '.btn-toggle-dropdown', function (e) {
        e.stopPropagation();
        const $dropdown = $(this).closest('.relative').find('.dropdown-menu');
        const isExpanded = $(this).attr('aria-expanded') === 'true';

        $('.dropdown-menu').not($dropdown).removeClass('show');
        $('.btn-toggle-dropdown').not(this).attr('aria-expanded', 'false');

        if (isExpanded) {
            $dropdown.removeClass('show');
        } else {
            $dropdown.addClass('show');
        }

        $(this).attr('aria-expanded', !isExpanded);
    });

    $(document).on('click', function () {
        $('.dropdown-menu').removeClass('show');
        $('.btn-toggle-dropdown').attr('aria-expanded', 'false');
    });

    $(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
    });


    //tooltip

    $('[data-tooltip-target]').each(function () {
        const $btn = $(this), $tip = $('#' + $btn.data('tooltip-target'));
        if (!$tip.length) return;

        $tip.addClass('absolute z-50 invisible opacity-0 scale-95 px-3 py-2 rounded-lg shadow-sm transition-all duration-200 transform text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-600 cus-tooltip');

        $btn.on({
            mouseenter: () => showTooltip($btn, $tip, $btn.data('tooltip-placement') || 'top'),
            mouseleave: () => $tip.addClass('invisible opacity-0')
        });
    });

    function showTooltip($btn, $tip, p) {
        const r = $btn[0].getBoundingClientRect();
        $tip.removeClass('invisible opacity-0 scale-95')
            .find('.tooltip-arrow').remove()
            .end()
            .append(createArrow(p));

        const pos = {
            top: [r.top - $tip.outerHeight() - 10, r.left + r.width / 2 - $tip.outerWidth() / 2],
            bottom: [r.bottom + 10, r.left + r.width / 2 - $tip.outerWidth() / 2],
            left: [r.top + r.height / 2 - $tip.outerHeight() / 2, r.left - $tip.outerWidth() - 10],
            right: [r.top + r.height / 2 - $tip.outerHeight() / 2, r.right + 10]
        }[p];

        $tip.css({ top: pos[0] + window.scrollY + 'px', left: pos[1] + window.scrollX + 'px' });
    }

    function createArrow(p) {
        const arrows = {
            top: '-bottom-1 left-1/2 -translate-x-1/2 rotate-45 border-b border-r',
            bottom: '-top-1 left-1/2 -translate-x-1/2 rotate-45 border-t border-r',
            left: '-right-1 top-1/2 -translate-y-1/2 rotate-45 border-t border-r',
            right: '-left-1 top-1/2 -translate-y-1/2 rotate-45 border-t border-l'
        };
        return $(`<div class="absolute w-2 h-2 bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-600 ${arrows[p]} tooltip-arrow"></div>`);
    }
    //End tooltip
});