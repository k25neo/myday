window.onload = function () {

  tinymce.init({
    selector: 'textarea',  // change this value according to your HTML
  });

  //event
  $('body').on('click', function () {
    var eventClosePopup = new Event('closePopup', {
      bubbles: true,
      cancelable: true
    });
    console.log('click');
    document.dispatchEvent(eventClosePopup);
  });

jQuery.event.special.closePopup = {
  setup: function (data, namespaces) {
    var elem = this;
  },

  teardown: function (namespaces) {
    var elem = this;
  }
};

//messages
$('body').on('click', '.js-open-write-message', function(){
  var $this = $(this);
  if($this.hasClass('open')){
    $this.text('Написать сообщение');
    $('.write-message').removeClass('open');
    $this.removeClass('open');
  }else{
    $this.addClass('open');
    $('.write-message').addClass('open');
    $this.text('Закрыть');
  }
});

$('body').on('click', '.js-changePicture', function(){
  var $fileImage = $(this).parent().find('input[name="image"]');
  $fileImage.on('change', function(){
    if($(this)[0].files.length > 0){
      $(this).closest('form').submit();
    }
  });
  $fileImage.click();
});
$('body').on('click', '.js-profileModal', function(){
  $dataID = $(this).data('id');

  $('#profile_modal .form__input_container').hide();
  var $inputContainer = $('#profile_modal').find('.form__input_container[data-id="'+$dataID+'"]');
  $inputContainer.show();
  var $myInput = $inputContainer.find('input');

  if(typeof $myInput != 'undefined' && $myInput.length > 0){
    switch ($myInput[0].getAttribute("name")) {
      case 'phone':
        vanillaTextMask.maskInput({
          inputElement: $myInput[0],
          mask: ['+','7','(', /[1-9]/, /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, '-', /\d/, /\d/, '-', /\d/, /\d/]
        })
        break;
      default:
    };
  }
  $('#profile_modal').addClass('open');
});

  //modal
  $('.ReactModalPortal .close_button').on('click', function(){
    $(this).closest('.ReactModalPortal').removeClass('open');
  });

  //tab
  $('.pulse-tabs > li').on('click', function(){
    $(this).siblings().removeClass('is-selected');
    $(this).addClass('is-selected');

    $('.pulse-tabs-data').removeClass('open');
    var dataID = $(this).data('tab');
    $('#' + dataID).addClass('open');
  });

  //board menu
  function BoardGroupMenu() {
    this.init();
  }
  BoardGroupMenu.prototype = {
    init: function () {
      this.$body = $('body');
      this.$boardGroupMenu = $('.js-board-group-menu');
      this.addHandlers();
    },
    addHandlers: function () {
      this.$boardGroupMenu.on('click', this.showMenu.bind(this));
    },
    showMenu: function () {
      this.$boardGroupMenu.toggleClass('open');
    }
  }
  var boardGroupMenu = new BoardGroupMenu();
  //menu
  function PopupMenu(el) {
    console.log(el);
    this.el = el;
    this.$el = $(this.el);
    this.init();
  }
  PopupMenu.prototype = {
    init: function () {
      this.dataID = this.$el.data('menu');
      this.$menu = $('#' + this.dataID);
      this.menu = document.getElementById(this.dataID);
      this.addHadlers();
    },
    closePopup: function (e) {
      console.log('1232');
      this.$menu.removeClass('open');
    },
    addHadlers: function () {
      console.log(this.menu);
      console.log(this.menu.addEventListener('closePopup', this.closePopup.bind(this), false));
      this.$el.on('click', this.togglePopup.bind(this));
    },
    togglePopup: function () {
      if (this.$menu.hasClass('open')) {
        this.$menu.removeClass('open');
      } else {
        this.$menu.addClass('open');
      }
    }
  }
  function PopupMenuManager() {
    this.init();
  }
  PopupMenuManager.prototype = {
    init: function () {
      this.arPopupMenu = [];
      this.$body = $('body');
      this.$popupMenu = this.$body.find('.popup_menu');
      this.$popupMenu.each(function (i, el) {
        this.arPopupMenu.push(new PopupMenu(this.$popupMenu[i]));
      }.bind(this));
      this.addHadlers();
    },
    addHadlers: function () {

    }
  }
  var popupMenuManager = new PopupMenuManager();

  $('.collapse-group-toggle-component').on('click', function () {
    var $fa = $(this).find('i');
    if ($fa.hasClass('fa-compress')) {
      $fa.removeClass('fa-compress');
      $fa.addClass('fa-expand');
    } else {
      $fa.removeClass('fa-expand');
      $fa.addClass('fa-compress');
    }
  });
};
