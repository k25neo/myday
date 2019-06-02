window.onload = function () {

  tinymce.init({
    selector: 'textarea',  // change this value according to your HTML
  });

  //EventBus
  const EventBus = {
    channels: {},
    subscribe (channelName, listener) {
      if (!this.channels[channelName]){
        this.channels[channelName] = []
      }
      this.channels[channelName].push(listener)
    },
    publish (channelName, data) {
      const channel = this.channels[channelName]
      if (!channel || !channel.length) {
        return
      }
      channel.forEach(listener => listener(data))
    }
  }
  //end EventBus
  //event
  document.addEventListener('click', function (event) {
    EventBus.publish('modal/close',{
      event: event,
    });
  });

// begin user-select
function UserSelect(el){
  this.open = false;
  this.$el = $(el);
  this.init();
}
UserSelect.prototype = {
  init:function(){
    this.tplUserSelectModal = `
    <div class="user-select-modal">
      <div class="user-select-selected"></div>
      <div class="user-select-all"></div>
    </div>
    `;
    this.$input = this.$el.find('input[name="users"]');
    this.task_id = this.$el.data('task');
    this.personImageWrapper = this.$el.find('.person-image-wrapper');
    this.user_selected = [];
    this.addHandlers();
  },
  addHandlers: function(){
    this.personImageWrapper.on('click', this.onClick.bind(this));
    EventBus.subscribe('modal/close', this.close.bind(this));
  },
  close: function(params){
      var $target = $(params.event.target);
      console.log($target);
      if($target.closest('.js-user-select').length ||
         $target.closest('.user-selected-del').length){
        return;
      }
      if(this.$modal){
        this.$modal.removeClass('open');
        this.dataUpdate();
      }
  },
  userDel: function(e){
    var $this = $(e.currentTarget);
    var $user = $this.closest('.user-selected-item');

    var user_id = $user.data('id');

    var index = this.user_selected.indexOf(user_id);
    if (index > -1) {
      this.user_selected.splice(index, 1);
    }
    this.inputUpdateVal();
    console.log('userDel', this.user_selected);

    $user.remove();
    this.$modalUsers.find('.user-all-item[data-id="'+user_id+'"]').removeClass('hidden');
    this.personImageWrapper.find('img[data-id="'+user_id+'"]').remove();
  },
  userAdd: function(e){
    var $this = $(e.currentTarget);
    var user_id = $this.data('id');
    var index = this.user_selected.push(user_id);
    var element = {};
    element.id = user_id;
    element.name = $this.text().trim();
    element.image = $this.find('img').attr('src');
    $this.addClass('hidden');
    var tplUserSelectedItem = `
    <div class="user-selected-item" data-id="${element.id}">
    ${ (element.name ? element.name : element.login) }
    <span class="user-selected-del">x</span>
    </div>`;
    this.$modalSelected.append(
      $(tplUserSelectedItem)
    );
    this.inputUpdateVal();
    this.personImageWrapper.append($(`
      <img data-id="${element.id}" src="${ (element.image ? element.image : '/img/person_noimage.svg') }"
       class="person-bullet-image person-bullet-component inline-image"
       title="${element.name}" alt="${element.name}">
      `));
  },
  inputUpdateVal: function(){
    this.$input.eq(0).val(this.user_selected);
  },
  onClick: function(){
    this.open = true;
    this.$modal = this.$el.find('.user-select-modal');
    if ( this.$modal.length > 0) {
      this.$modal.addClass('open');
    }else{
      this.$el.append($(this.tplUserSelectModal));
      this.$modal = this.$el.find('.user-select-modal');
      this.$modalSelected = this.$modal.find('.user-select-selected');
      this.$modalUsers = this.$modal.find('.user-select-all');
      this.dataLoad();
      this.$modalSelected.on('click', '.user-selected-del', this.userDel.bind(this));
      this.$modalUsers.on('click', '.user-all-item', this.userAdd.bind(this));
    };
  },
  dataLoad: function(){
    var $url = `/task/${this.task_id}/users`;
    $data = '';
    $.ajax({
      url: $url,
      dataType: 'json',
      data: $data,
      type: "GET",
    }).done(function(data){

      data.task_users.forEach(function(element){
        var tplUserSelectedItem = `
        <div class="user-selected-item" data-id="${element.id}">
        ${ (element.name ? element.name : element.login) }
        <span class="user-selected-del">x</span>
        </div>`;
        this.user_selected.push(element.id);
        this.$modalSelected.append(
          $(tplUserSelectedItem)
        );
      }.bind(this));

      data.all_users.forEach(function(element){
        this.$modalUsers.append(
          $(`<div class="user-all-item
          ${ (this.user_selected.includes(element.id) ? 'hidden': '') }"
          data-id="${element.id}">
          <img class="person-bullet-image person-bullet-component inline-image"
           src="${ (element.image ? '/storage/'+element.image : '/img/person_noimage.svg') }">
          ${ (element.name ? element.name : element.login) }
          </div>`)
        );
      }.bind(this));
      this.$modal.addClass('open');

    }.bind(this));
  },
  dataUpdate: function(){
    var $url = `/task/${this.task_id}/users`;
    $data = {
      'users':this.$input.val(),
      '_method': 'PUT',
      '_token': $('meta[name="csrf-token"]').attr('content'),
    }
    $.ajax({
      url: $url,
      dataType: 'json',
      data: $data,
      type: "POST",
    }).done(function(data){
      console.log(data);
    })
  }
}
function UserSelectManager(){
  this.userSelects = [];
  this.init();
}
UserSelectManager.prototype = {
  init: function(){
    this.$arUserSelect = $('.js-user-select');
    this.$arUserSelect.each(function(i,el){
      this.userSelects.push( new UserSelect(el) );
    }.bind(this));
  }
}
var userSelectManager = new UserSelectManager();
// end user-select

function CustomSelect(el){
  this.$el = $(el);
  this.init();
}
CustomSelect.prototype = {
  init: function(){
    this.style = this.$el.attr('style');
    this.$selectNative = this.$el.find('select');
    this.$selectOptions = this.$selectNative.find('option');
    this.$selectedElem = this.$selectNative.find('option[selected]');
    this.$selectSelected = $(
      '<div class="select-selected">'+
        this.$selectedElem.text()+
      '</div>'
    );
    this.$el.append(this.$selectSelected);
    this.$selectItems = $('<div class="select-items select-hide"></div>');
    this.$selectOptions.each(function(i,el){
      this.$selectItems.append($('<div class="select-item">'+$(el).text()+'</div>'));
    }.bind(this));
    this.$selectItems.attr('style',this.style);
    this.$el.append(this.$selectItems);
    this.$selectItem = this.$selectItems.find('.select-item');
    this.addHandlers();
  },
  addHandlers: function(){
    this.$selectSelected.on('click', this.showItems.bind(this));
    this.$selectItem.on('click', this.selectItem.bind(this));
    EventBus.subscribe('modal/close', this.close.bind(this));
  },
  showItems: function(){
    this.$selectItems.toggleClass('select-hide');
  },
  selectItem: function(e){
    this.$selectNative.find('option').each(function(){
      $(this).attr('selected', false);
    });
    this.$selectedElem = this.$selectOptions.eq($(e.currentTarget).index()).attr('selected', 'selected');
    this.$selectSelected.text(  this.$selectedElem.text() );
    this.$selectItems.addClass('select-hide');
    this.$el.closest('form').submit();
  },
  close: function(params){
      var $target = $(params.event.target);
      if($target.closest('.js-custom-select').length){
        return;
      }
      this.$selectItems.addClass('select-hide');
  }
}
function CustomSelectManager(){
  this.$body = $('body');
  this.init();
}
CustomSelectManager.prototype = {
  init: function(){
     this.customSelects = [];
     this.$customSelects = this.$body.find('.js-custom-select');
     this.$customSelects.each(function(i,el){
       this.customSelects.push(new CustomSelect(el));
     }.bind(this));
  }
}
var customSelectManager = new CustomSelectManager();

function InputCell(el){
  this.$el = $(el);
  this.init();
}
InputCell.prototype = {
  init: function(){
    this.$row = this.$el.closest('.board-group-row');
    this.value = this.$el.val();
    this.addHandlers();
  },
  addHandlers: function(){
    this.$el.on('click', this.onClick.bind(this));
    EventBus.subscribe('modal/close', this.close.bind(this));
  },
  onClick: function(){
    this.edit();
  },
  edit: function(){
    this.$el.attr('readonly', false);
    this.$row.addClass('edit');
  },
  close: function(params){
    var $target = $(params.event.target);

    if(
      $target.closest('.board-group-cell').length ||
      $target.closest('.datepicker').length ||
      $target.closest('.datepicker--cell').length ||
      $target.closest('.datepicker--nav').length ||
      $target.closest('.datepicker--nav-title').length ||
      $target.closest('.datepicker--nav-action').length
    ){return}

    this.$row.removeClass('edit');
    this.$el.attr('readonly', true);
    this.$el.val(this.value);
  }
}
function BoardGroupRow(el){
  this.$el = $(el);
  this.init();
}
BoardGroupRow.prototype = {
  init: function(){
    this.inputs = [];
    this.$input = this.$el.find('input.input-cell');
    this.$input.each(function(i,el){
      this.inputs.push(new InputCell(el));
    }.bind(this));
  }
}
function BoardGroupRowManager(){
  this.init();
}
BoardGroupRowManager.prototype = {
  init: function(){
    this.$row = $('.board-group-row');
    this.rows = [];
    this.$row.each(function(i,el){
      this.rows.push(new BoardGroupRow(el));
    }.bind(this));
  }
}
var boardGroupRowManager = new BoardGroupRowManager();

function AddCellComponentManager(){
  this.init();
}
AddCellComponentManager.prototype = {
  init: function(){
    this.arAddCellComponent = [];
    this.$AddCellComponent = $('.js-add-cell-component');
    this.$AddCellComponent.each(function(i,el){
      this.arAddCellComponent.push( new AddCellComponent(el) );
    }.bind(this));
  }
}
//js-add-cell-component
function AddCellComponent(el){
  this.$el = $(el);
  this.init();
}
AddCellComponent.prototype = {
  init: function(){
    this.$addCell = this.$el.find('.add-cell-component');
    this.$input = this.$addCell.find('input');
    this.addEventHandlers();
    this.value = this.$input.val();
  },
  addEventHandlers: function(){
    this.$el.on('click', this.onClick.bind(this));
    EventBus.subscribe('modal/close', this.close.bind(this));
  },
  onClick: function(){
    this.edit();
  },
  edit: function(){
    this.$el.addClass('edit');
    this.$input.attr('readonly', false);
  },
  close: function(params){
    var $target = $(params.event.target);
    if($target.closest('.js-add-cell-component').length){return}

    this.$el.removeClass('edit');
    this.$input.attr('readonly', true);
    this.$input.val(this.value);
  }
}
var addCellComponentManager = new AddCellComponentManager();
//end js-add-cell-component

//start js-editable-component
function EditableComponent(el, $form){
  this.el = el;
  this.$el = $(el);
  this.$form = $form;
  this.init();
}
EditableComponent.prototype = {
  init: function(){
    this.$input = this.$el.find('input');
    this.inputVal = this.$input.val();
    this.$edIconCont = this.$el.find('.edit_icon_container');
    this.$edBtnCont = this.$el.find('.edit-btn__container');
    this.$edBtnCancel = this.$el.find('.js-edit-btn-cancel');
    this.$edBtnApply = this.$el.find('.js-edit-btn-apply');
    this.addEventHandlers();
  },
  addEventHandlers: function(){
    this.$el.on('click', this.onClick.bind(this));
    this.$edBtnCancel.on('click', this.onCancel.bind(this));
    this.$edBtnApply.on('click', this.onApply.bind(this));
  },
  edit: function(){
    this.$input.attr('readonly', false);
    this.$el.addClass('edit');
    this.$edIconCont.hide();
    this.$edBtnCont.show();
    this.status = 'edit';
  },
  onApply: function(){
    this.$form.submit();
  },
  onClick: function(){
    switch (this.status) {
      case 'cancel':
        this.status = 'edit';
        break;
      case 'edit':
        this.edit();
        break;
      default:
        this.edit();
      }

  },
  onCancel: function(e){
    this.status = 'cancel';
    this.$el.removeClass('edit');
    this.$edIconCont.show();
    this.$edBtnCont.hide();
    this.$input.val(this.inputVal);
    this.$input.attr('readonly', true);
  }
}

function EditableComponentManager(){
  this.init();
}
EditableComponentManager.prototype = {
  init: function(){
    this.arEditableComponents = [];
    this.$body = $('body');
    this.$editableComponent = this.$body.find('.js-editable-component');
    this.$editableComponent.each(function(i, el){
      this.$form = this.$editableComponent[i].closest('form');
      this.arEditableComponents.push(new EditableComponent(el,this.$form));
    }.bind(this));
  }
}
var editableComponentManager = new EditableComponentManager();

//end js-editable-component

//add board menu
$('body').on('click', '.js-open-add-board', function(){
  $('#add_board_modal').addClass('open');
});

//add group
$('body').on('click', '.js-add-group-modal', function(){
  $('#add_group_modal').addClass('open');
})

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
  function BoardGroupMenu(el) {
    this.$el = $(el);
    this.init();
  }
  BoardGroupMenu.prototype = {
    init: function () {
      this.$boardContentComponent = this.$el.closest('.board-content-component');
      this.$boardGroupHeader = this.$boardContentComponent.find('.board-group-header');
      this.$boardGroupBody = this.$boardContentComponent.find('.board-group-body');
      this.$boardGroupFooter = this.$boardContentComponent.find('.board-group-footer');
      this.$jsCollapseGroup = this.$boardContentComponent.find('.js-collapse-group');

      this.addHandlers();
    },
    addHandlers: function () {
      this.$el.on('click', this.showMenu.bind(this));
      this.$jsCollapseGroup.on('click', this.toggleCollapseGroup.bind(this));
      EventBus.subscribe('modal/close', this.close.bind(this));
    },
    close: function(params){
      var $target = $(params.event.target);
      if( $target.closest('.js-board-group-menu').length ){return}
      this.$el.removeClass('open');
    },
    showMenu: function () {
      this.$el.toggleClass('open');
    },
    toggleCollapseGroup: function(){
      if(this.$boardContentComponent.hasClass('collapsed')){
        this.expandGroup();
      }else{
        this.collapseGroup();
      }
    },
    collapseGroup: function(){
      this.$boardContentComponent.addClass('collapsed');
      this.$jsCollapseGroup.text('Развернуть группу');
    },
    expandGroup: function(){
      this.$boardContentComponent.removeClass('collapsed');
      this.$jsCollapseGroup.text('Свернуть группу');
    }
  }

  function BoardGroupMenuManager(){
    this.init();
  }
  BoardGroupMenuManager.prototype = {
    init: function(){
      this.$body = $('body');
      this.arBoardGroupMenu = [];
      this.$boardGroupMenu = $('.js-board-group-menu');
      this.$boardGroupMenu.each(function(i,el){
        this.arBoardGroupMenu.push( new BoardGroupMenu(el) );
      }.bind(this));
    },
    collapseGroups: function(){
      this.arBoardGroupMenu.forEach(function(oGroup, i, arr){
        oGroup.collapseGroup();
      });
    },
    expandGroups: function(){
      this.arBoardGroupMenu.forEach(function(oGroup, i, arr){
        oGroup.expandGroup();
      });
    }
  }
  window.boardGroupMenuManager = new BoardGroupMenuManager();

  $('.collapse-group-toggle-component').on('click', function(e){
    if( $(e.currentTarget).hasClass('group-collapsed') ){
      $(e.currentTarget).removeClass('group-collapsed');
      window.boardGroupMenuManager.expandGroups();
    }else{
      $(e.currentTarget).addClass('group-collapsed');
      window.boardGroupMenuManager.collapseGroups();
    }

  });

  //menu
  function PopupMenu(el) {
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
    close: function (params) {
      var $target = $(params.event.target);
      if( $target.closest('#' + this.dataID).length
        || $target.closest('.popup_menu').length ){return}
      this.$menu.removeClass('open');
    },
    addHadlers: function () {
      EventBus.subscribe('modal/close', this.close.bind(this));
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
