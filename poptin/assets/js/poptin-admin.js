jQuery(document).ready(function ($) {
  jQuery('.wheremyid').on('click', function (e) {
    $('#oopsiewrongid').modal('hide');
    jQuery('#whereIsMyId').modal('show').css({
      left() {
        const sidebarWidth = jQuery('#adminmenuwrap').width();
        const value = innerWidth > 782 ? sidebarWidth : 0;
        return `${value}px`;
      }
    })
  });

  function show_loader(el) {
    $(el).find('.text-content').hide();
    $(el).find('.loader').show();
  }

  function hide_loader(el) {
    $(el).find('.text-content').show();
    $(el).find('.loader').hide();
  }

  jQuery('.pp_signup_btn').on('click', function (e) {
    e.preventDefault();
    var email = $('#poptinRegisterEmail').val();
    if (!isEmail(email)) {
      e.preventDefault();
      $('#oopsiewrongemailid').fadeIn(500);

      $('#oopsiewrongemailid').delay(2500).fadeOut();
      $('#poptinRegisterEmail')
        .addClass('error')
        .delay(3000)
        .queue(function () {
          $(this).removeClass('error').dequeue();
        });

      return false;
    } else {
      var el = this;
      show_loader(el);
      jQuery.ajax({
        url: ajaxurl,
        dataType: 'JSON',
        method: 'POST',
        data: jQuery('#registration_form').serialize(),
        success: function (data) {
          hide_loader(el);
          if (data.success == true) {
            jQuery('.ppaccountmanager').fadeOut(300);
            jQuery('#customersWrap').fadeOut(300);
            jQuery('.poptinLogged').fadeIn(300);
            jQuery('.poptinLoggedBg').fadeIn(300);
            $('.goto_dashboard_button_pp_updatable').attr(
              'href',
                poptin_settings.after_registration_url
            );
            // window.open("admin.php?page=Poptin&poptin_logmein=true&after_registration=wordpress","_blank");
          } else {
            if (
              data.message === 'Registration failed. User already registered.'
            ) {
              jQuery('#lookfamiliar').modal();
            } else if ((data.message = 'The email has already been taken.')) {
              jQuery('#lookfamiliar').modal();
            } else {
              swal('Error', data.message, 'error');
            }
          }
        }
      });
    }
  });

  jQuery('.goto_dashboard_button_pp_updatable').on('click', function () {
    link = $(this);
    href = link.attr('href');
    setTimeout(function () {
      link.attr('href', href.replace('&after_registration=wordpress', ''));
    }, 1000);
  });

  jQuery('.dashboard_link').on('click', function () {
    href = $(this).data('target');
    window.open(href, '_blank');
  });

  jQuery(document).on('click', '.deactivate-poptin-confirm-yes', function () {
    var el = this;
    show_loader(el);
    jQuery.post(
      ajaxurl,
      {
        action: 'delete-id',
        data: { nonce: $('#ppFormIdDeactivate').val() }
      },
      function (status) {
        hide_loader(el);
        status = JSON.parse(status);
        if (status.success == true) {
          jQuery('#makingsure').modal('hide');
          jQuery('#byebyeModal').modal('show');
          $('.poptinLogged').hide();
          $('.poptinLoggedBg').hide();
          $('.ppaccountmanager').fadeIn('slow');
          $('#customersWrap').fadeIn('slow');
          $('.popotinLogin').show();
          $('.popotinRegister').hide();
        }
      }
    );
  });

  jQuery('.pplogout').on('click', function (e) {
    e.preventDefault();
    jQuery('#makingsure').modal('show');
  });

  jQuery('.poptinWalkthroughVideoTrigger').on('click', function (e) {
    e.preventDefault();
    jQuery('#poptinExplanatoryVideo').modal({
      backdrop: true,
      keyboard: true,
      show: true
    }).css({
      left() {
        const sidebarWidth = jQuery('#adminmenuwrap').width();
        const value = innerWidth > 782 ? sidebarWidth : 0;
        return `${value}px`;
      }
    })
  });

  // close modal when wordpress sidebar collapse
  jQuery(document).on('click', '#collapse-menu', function () {
    jQuery('#poptinExplanatoryVideo').modal('hide');
  });

  $('.ppLogin').on('click', function (e) {
    e.preventDefault();
    $('.popotinLogin').fadeIn('slow');
    $('.popotinRegister').hide();
    $('#poptinUserId').focus();
  });

  $('.ppRegister').on('click', function (e) {
    e.preventDefault();
    $('.popotinRegister').fadeIn('slow');
    $('.popotinLogin').hide();
    $('#poptinRegisterEmail').focus();
  });

  $('.ppFormLogin').on('submit', function (e) {
    e.preventDefault();
    var id = $('.ppFormLogin input[type="text"]').val();
    if (id.length != 13) {
      e.preventDefault();
      //   $('#oopsiewrongid').modal('show');
      $('#oopsiewrongid').fadeIn(500);

      $('#oopsiewrongid').delay(2500).fadeOut();
      $('#poptinUserId')
        .addClass('error')
        .delay(3000)
        .queue(function () {
          $(this).removeClass('error').dequeue();
        });
      return false;
    } else {
      var el = this;
      show_loader(el);
      $.post(
        ajaxurl,
        {
          data: { poptin_id: id, nonce: $('#ppFormIdRegister').val() },
          action: 'add-id'
        },
        function (status) {
          hide_loader(el);
          status = JSON.parse(status);
          if (status.success == true) {
            jQuery('.poptinLogged').fadeIn('slow');
            jQuery('.poptinLoggedBg').fadeIn('slow');
            jQuery('#customersWrap').hide();
            jQuery('.ppaccountmanager').hide();
            jQuery('.popotinLogin').hide();
            jQuery('.popotinRegister').hide();
            $('.goto_dashboard_button_pp_updatable').attr(
              'href',
              'https://app.popt.in/login'
            );
          }
        }
      );
    }
  });

  $('input').on('change', function (e) {
    let value = e.target.value;
    if (value) {
      $(this).addClass('active');
    } else {
      $(this).removeClass('active');
    }
  });
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

/**
 * ------------------------------------------------
 * Start: Support widget popup script
 * @since 1.3.2
 * ------------------------------------------------ 
 */ 
const poptinSupportWidgetBase = {
  getSelectors() {
    return {
      scope: '.ps-widget',
      triggerBtn: '.ps-widget__trigger-btn',
      popover: '.ps-widget__popover',
      headerBg: '.ps-widget__popover__header__bg',
      bird: '.ps-widget__popover__header__bird'
    }
  },

  getElements() {
    const selectors = this.getSelectors()
    const $scope = this.$(selectors.scope)

    return {
      $scope,
      $document: this.$(document),
      $triggerBtn: $scope.find(selectors.triggerBtn),
      $popover: $scope.find(selectors.popover),
      $headerBg: $scope.find(selectors.headerBg),
      $bird: $scope.find(selectors.bird)
    }
  },

  get isPopoverOpen() {
    const { $popover } = this.getElements()
    return $popover.hasClass('open')
  },

  reset() {
    const { $popover, $headerBg, $bird, $triggerBtn, $document } = this.getElements()
    $popover.removeClass('open').removeAttr('style')
    $headerBg.removeAttr('style')
    $bird.removeAttr('style')
    $triggerBtn.find('img').removeAttr('style')
    $document.off('click.ps-outside-click')
  },
  
  init( $ ) {
    this.$ = $
    const { $scope } = this.getElements()
    if( !$scope.length ) return;
    this.events()
  }
}

const poptinSupportWidget = jQuery.extend(poptinSupportWidgetBase, {
  events() {
    const { $triggerBtn} = this.getElements()
    $triggerBtn.on('click', this.popoverToggleHandler.bind(this))
  },
  
  popoverToggleHandler( ev ) {
    ev.preventDefault()
    ev.stopPropagation()

    const { $document } = this.getElements()
    
    if( !this.isPopoverOpen ) {
      if( innerWidth < 782 ) { 
        this.$('#poptinExplanatoryVideo').modal('hide');
        this.$('#whereIsMyId').modal('hide')
      }
      this.animateAndOpenPopover()
      $document.on('click.ps-outside-click', this.outsideCloseHandler.bind(this))
      return;
    }

    this.animateAndClosePopover()
  },

  outsideCloseHandler( ev ) {
    const $target = this.$(ev.target)
    const { $popover, $triggerBtn } = this.getElements()
  
    if( $target.closest($popover).length || $target.closest($triggerBtn).length ) {
      return;
    }

    this.animateAndClosePopover()
  },

  animateAndOpenPopover() {
    const { $popover, $headerBg, $bird, $triggerBtn } = this.getElements()
    const openingStyles = {
      bottom: 80,
      opacity: 1
    }
    
    $triggerBtn.find('img').css('transform', 'rotate(180deg)')
    $popover.show().animate(openingStyles, 300, () => {
      $popover.addClass('open')
    })

    $bird.animate({ right: 0 }, 500)
    $headerBg.css('transform', 'scaleY(1)')
  },

  animateAndClosePopover() {
    const { $popover, $triggerBtn } = this.getElements()
    const openingStyles = {
      bottom: 30,
      opacity: 0
    }

    $triggerBtn.find('img').css('transform', 'rotate(0deg)')
    $popover.animate(openingStyles, 300, this.reset.bind(this))
    $popover.fadeOut('slow')
  },
})

jQuery(($) => poptinSupportWidget.init($))
/**
 * ------------------------------------------------
 * End: Support widget popup script
 * ------------------------------------------------ 
 */ 