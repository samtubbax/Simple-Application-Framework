// Generated by CoffeeScript 1.6.3
(function() {
  var SearchForm,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  SearchForm = (function(_super) {
    __extends(SearchForm, _super);

    function SearchForm() {
      this._initSearch();
    }

    SearchForm.prototype._initSearch = function() {
      var $searchField,
        _this = this;
      $searchField = $('.searchBox input[name=q]', this.form);
      $searchField.autocomplete({
        position: {
          using: function(position, elements) {
            var newPosition;
            newPosition = {
              left: position.left,
              top: 'auto',
              bottom: elements.target.height,
              margin: 0
            };
            return elements.element.element.css(newPosition);
          }
        },
        source: function(request, response) {
          return $.ajax({
            url: '/ajax.php?module=core&action=search&language=' + Data.get('core.language'),
            data: {
              q: request.term
            },
            success: function(data) {
              var items, value, _i, _len, _ref;
              items = [];
              _ref = data.data;
              for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                value = _ref[_i];
                items.push({
                  label: "" + value.label + " (" + value.module + ")",
                  value: value
                });
              }
              return response(items);
            }
          });
        },
        select: function(e, ui) {
          e.preventDefault();
          if (ui.item.value.url != null) {
            return document.location = ui.item.value.url;
          } else if (ui.item.value.value != null) {
            return ui.item.value.value;
          } else {
            return ui.item.label;
          }
        },
        focus: function(e, ui) {
          e.preventDefault();
          return $(e.target).val(ui.item.value.label);
        }
      });
      $searchField.each(function(idx, element) {
        return $(element).data('ui-autocomplete')._renderItem = _this.renderItem;
      });
    };

    SearchForm.prototype.renderItem = function(ul, item) {
      return $('<li>').append($('<a>').append(item.value.label + '<small class="muted"> (' + item.value.module + ')</small>')).appendTo(ul);
    };

    return SearchForm;

  })(Form);

  window.SearchForm = SearchForm;

}).call(this);
