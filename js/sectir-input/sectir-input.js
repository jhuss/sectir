/*! ngTagsInput v2.1.1 License: MIT */!function(){"use strict";function a(){var a={};return{on:function(b,c){return b.split(" ").forEach(function(b){a[b]||(a[b]=[]),a[b].push(c)}),this},trigger:function(b,c){return angular.forEach(a[b],function(a){a.call(null,c)}),this}}}function b(a,b){return a=a||[],a.length>0&&!angular.isObject(a[0])&&a.forEach(function(c,d){a[d]={},a[d][b]=c}),a}function c(a,b,c){for(var d=null,f=0;f<a.length;f++)if(e(a[f][c]).toLowerCase()===e(b[c]).toLowerCase()){d=a[f];break}return d}function d(a,b,c){if(!b)return a;var d=b.replace(/([.?*+^$[\]\\(){}|-])/g,"\\$1");return a.replace(new RegExp(d,"gi"),c)}function e(a){return angular.isUndefined(a)||null==a?"":a.toString().trim()}function f(a){return a.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;")}var g={backspace:8,tab:9,enter:13,escape:27,space:32,up:38,down:40,comma:188},h=9007199254740991,i=["text","email","url"],j=angular.module("ngTagsInput",[]);j.directive("tagsInput",["$timeout","$document","tagsInputConfig",function(d,f,j){function k(a,b){var d,f,g,h={};return d=function(b){return e(b[a.displayProperty])},f=function(b,c){b[a.displayProperty]=c},g=function(b){var e=d(b);return e&&e.length>=a.minLength&&e.length<=a.maxLength&&a.allowedTagsPattern.test(e)&&!c(h.items,b,a.displayProperty)},h.items=[],h.addText=function(a){var b={};return f(b,a),h.add(b)},h.add=function(c){var e=d(c);return a.replaceSpacesWithDashes&&(e=e.replace(/\s/g,"-")),f(c,e),g(c)?(h.items.push(c),b.trigger("tag-added",{$tag:c})):e&&b.trigger("invalid-tag",{$tag:c}),c},h.remove=function(a){var c=h.items.splice(a,1)[0];return b.trigger("tag-removed",{$tag:c}),c},h.removeLast=function(){var b,c=h.items.length-1;return a.enableEditingLastTag||h.selected?(h.selected=null,b=h.remove(c)):h.selected||(h.selected=h.items[c]),b},h}function l(a){return-1!==i.indexOf(a)}return{restrict:"E",require:"ngModel",scope:{tags:"=ngModel",onTagAdded:"&",onTagRemoved:"&"},replace:!1,transclude:!0,templateUrl:"ngTagsInput/tags-input.html",controller:["$scope","$attrs","$element",function(b,c,d){b.events=new a,j.load("tagsInput",b,c,{type:[String,"text",l],placeholder:[String,"Add a tag"],tabindex:[Number,null],removeTagSymbol:[String,String.fromCharCode(215)],replaceSpacesWithDashes:[Boolean,!0],minLength:[Number,3],maxLength:[Number,h],addOnEnter:[Boolean,!0],addOnSpace:[Boolean,!1],addOnComma:[Boolean,!0],addOnBlur:[Boolean,!0],allowedTagsPattern:[RegExp,/.+/],enableEditingLastTag:[Boolean,!1],minTags:[Number,0],maxTags:[Number,h],displayProperty:[String,"text"],allowLeftoverText:[Boolean,!1],addFromAutocompleteOnly:[Boolean,!1]}),b.tagList=new k(b.options,b.events),this.registerAutocomplete=function(){var a=d.find("input");return a.on("keydown",function(a){b.events.trigger("input-keydown",a)}),{addTag:function(a){return b.tagList.add(a)},focusInput:function(){a[0].focus()},getTags:function(){return b.tags},getCurrentTagText:function(){return b.newTag.text},getOptions:function(){return b.options},on:function(a,c){return b.events.on(a,c),this}}}}],link:function(a,c,h,i){var j,k=[g.enter,g.comma,g.space,g.backspace],l=a.tagList,m=a.events,n=a.options,o=c.find("input"),p=["minTags","maxTags","allowLeftoverText"];j=function(){i.$setValidity("maxTags",a.tags.length<=n.maxTags),i.$setValidity("minTags",a.tags.length>=n.minTags),i.$setValidity("leftoverText",n.allowLeftoverText?!0:!a.newTag.text)},m.on("tag-added",a.onTagAdded).on("tag-removed",a.onTagRemoved).on("tag-added",function(){a.newTag.text=""}).on("tag-added tag-removed",function(){i.$setViewValue(a.tags)}).on("invalid-tag",function(){a.newTag.invalid=!0}).on("input-change",function(){l.selected=null,a.newTag.invalid=null}).on("input-focus",function(){i.$setValidity("leftoverText",!0)}).on("input-blur",function(){n.addFromAutocompleteOnly||(n.addOnBlur&&l.addText(a.newTag.text),j())}).on("option-change",function(a){-1!==p.indexOf(a.name)&&j()}),a.newTag={text:"",invalid:null},a.getDisplayText=function(a){return e(a[n.displayProperty])},a.track=function(a){return a[n.displayProperty]},a.newTagChange=function(){m.trigger("input-change",a.newTag.text)},a.$watch("tags",function(c){a.tags=b(c,n.displayProperty),l.items=a.tags}),a.$watch("tags.length",function(){j()}),o.on("keydown",function(b){if(!b.isImmediatePropagationStopped||!b.isImmediatePropagationStopped()){var c,d,e=b.keyCode,f=b.shiftKey||b.altKey||b.ctrlKey||b.metaKey,h={};if(!f&&-1!==k.indexOf(e))if(h[g.enter]=n.addOnEnter,h[g.comma]=n.addOnComma,h[g.space]=n.addOnSpace,c=!n.addFromAutocompleteOnly&&h[e],d=!c&&e===g.backspace&&0===a.newTag.text.length,c)l.addText(a.newTag.text),a.$apply(),b.preventDefault();else if(d){var i=l.removeLast();i&&n.enableEditingLastTag&&(a.newTag.text=i[n.displayProperty]),a.$apply(),b.preventDefault()}}}).on("focus",function(){a.hasFocus||(a.hasFocus=!0,m.trigger("input-focus"),a.$apply())}).on("blur",function(){d(function(){var b=f.prop("activeElement"),d=b===o[0],e=c[0].contains(b);(d||!e)&&(a.hasFocus=!1,m.trigger("input-blur"))})}),c.find("div").on("click",function(){o[0].focus()})}}}]),j.directive("autoComplete",["$document","$timeout","$sce","tagsInputConfig",function(a,h,i,j){function k(a,d){var e,f,g,i={};return f=function(a,b){return a.filter(function(a){return!c(b,a,d.tagsInput.displayProperty)})},i.reset=function(){g=null,i.items=[],i.visible=!1,i.index=-1,i.selected=null,i.query=null,h.cancel(e)},i.show=function(){i.selected=null,i.visible=!0},i.load=function(c,j){h.cancel(e),e=h(function(){i.query=c;var e=a({$query:c});g=e,e.then(function(a){e===g&&(a=b(a.data||a,d.tagsInput.displayProperty),a=f(a,j),i.items=a.slice(0,d.maxResultsToShow),i.items.length>0?i.show():i.reset())})},d.debounceDelay,!1)},i.selectNext=function(){i.select(++i.index)},i.selectPrior=function(){i.select(--i.index)},i.select=function(a){0>a?a=i.items.length-1:a>=i.items.length&&(a=0),i.index=a,i.selected=i.items[a]},i.reset(),i}return{restrict:"E",require:"^tagsInput",scope:{source:"&"},templateUrl:"ngTagsInput/auto-complete.html",link:function(a,b,c,h){var l,m,n,o,p,q,r=[g.enter,g.tab,g.escape,g.up,g.down];j.load("autoComplete",a,c,{debounceDelay:[Number,100],minLength:[Number,3],highlightMatchedText:[Boolean,!0],maxResultsToShow:[Number,10],loadOnDownArrow:[Boolean,!1],loadOnEmpty:[Boolean,!1],loadOnFocus:[Boolean,!1]}),n=a.options,m=h.registerAutocomplete(),n.tagsInput=m.getOptions(),l=new k(a.source,n),o=function(a){return a[n.tagsInput.displayProperty]},p=function(a){return e(o(a))},q=function(a){return a&&a.length>=n.minLength||!a&&n.loadOnEmpty},a.suggestionList=l,a.addSuggestionByIndex=function(b){l.select(b),a.addSuggestion()},a.addSuggestion=function(){var a=!1;return l.selected&&(m.addTag(l.selected),l.reset(),m.focusInput(),a=!0),a},a.highlight=function(a){var b=p(a);return b=f(b),n.highlightMatchedText&&(b=d(b,f(l.query),"<em>$&</em>")),i.trustAsHtml(b)},a.track=function(a){return o(a)},m.on("tag-added tag-removed invalid-tag input-blur",function(){l.reset()}).on("input-change",function(a){q(a)?l.load(a,m.getTags()):l.reset()}).on("input-focus",function(){var a=m.getCurrentTagText();n.loadOnFocus&&q(a)&&l.load(a,m.getTags())}).on("input-keydown",function(b){var c=!1;b.stopImmediatePropagation=function(){c=!0,b.stopPropagation()},b.isImmediatePropagationStopped=function(){return c};var d=b.keyCode,e=!1;-1!==r.indexOf(d)&&(l.visible?d===g.down?(l.selectNext(),e=!0):d===g.up?(l.selectPrior(),e=!0):d===g.escape?(l.reset(),e=!0):(d===g.enter||d===g.tab)&&(e=a.addSuggestion()):d===g.down&&a.options.loadOnDownArrow&&(l.load(m.getCurrentTagText(),m.getTags()),e=!0),e&&(b.preventDefault(),b.stopImmediatePropagation(),a.$apply()))})}}}]),j.directive("tiTranscludeAppend",function(){return function(a,b,c,d,e){e(function(a){b.append(a)})}}),j.directive("tiAutosize",["tagsInputConfig",function(a){return{restrict:"A",require:"ngModel",link:function(b,c,d,e){var f,g,h=a.getTextAutosizeThreshold();f=angular.element('<span class="input"></span>'),f.css("display","none").css("visibility","hidden").css("width","auto").css("white-space","pre"),c.parent().append(f),g=function(a){var b,e=a;return angular.isString(e)&&0===e.length&&(e=d.placeholder),e&&(f.text(e),f.css("display",""),b=f.prop("offsetWidth"),f.css("display","none")),c.css("width",b?b+h+"px":""),a},e.$parsers.unshift(g),e.$formatters.unshift(g),d.$observe("placeholder",function(a){e.$modelValue||g(a)})}}}]),j.directive("tiBindAttrs",function(){return function(a,b,c){a.$watch(c.tiBindAttrs,function(a){angular.forEach(a,function(a,b){c.$set(b,a)})},!0)}}),j.provider("tagsInputConfig",function(){var a={},b={},c=3;this.setDefaults=function(b,c){return a[b]=c,this},this.setActiveInterpolation=function(a,c){return b[a]=c,this},this.setTextAutosizeThreshold=function(a){return c=a,this},this.$get=["$interpolate",function(d){var e={};return e[String]=function(a){return a},e[Number]=function(a){return parseInt(a,10)},e[Boolean]=function(a){return"true"===a.toLowerCase()},e[RegExp]=function(a){return new RegExp(a)},{load:function(c,f,g,h){var i=function(){return!0};f.options={},angular.forEach(h,function(h,j){var k,l,m,n,o,p;k=h[0],l=h[1],m=h[2]||i,n=e[k],o=function(){var b=a[c]&&a[c][j];return angular.isDefined(b)?b:l},p=function(a){f.options[j]=a&&m(a)?n(a):o()},b[c]&&b[c][j]?g.$observe(j,function(a){p(a),f.events.trigger("option-change",{name:j,newValue:a})}):p(g[j]&&d(g[j])(f.$parent))})},getTextAutosizeThreshold:function(){return c}}}]}),j.run(["$templateCache",function(a){a.put("ngTagsInput/tags-input.html",'<div class="host" tabindex="-1" ti-transclude-append=""><div class="tags" ng-class="{focused: hasFocus}"><ul class="tag-list"><li class="tag-item" ng-repeat="tag in tagList.items track by track(tag)" ng-class="{ selected: tag == tagList.selected }"><span ng-bind="getDisplayText(tag)"></span> <a class="remove-button" ng-click="tagList.remove($index)" ng-bind="options.removeTagSymbol"></a></li></ul><input class="input" ng-model="newTag.text" ng-change="newTagChange()" ng-trim="false" ng-class="{\'invalid-tag\': newTag.invalid}" ti-bind-attrs="{type: options.type, placeholder: options.placeholder, tabindex: options.tabindex}" ti-autosize=""></div></div>'),a.put("ngTagsInput/auto-complete.html",'<div class="autocomplete" ng-show="suggestionList.visible"><ul class="suggestion-list"><li class="suggestion-item" ng-repeat="item in suggestionList.items track by track(item)" ng-class="{selected: item == suggestionList.selected}" ng-click="addSuggestionByIndex($index)" ng-mouseenter="suggestionList.select($index)" ng-bind-html="highlight(item)"></li></ul></div>')}])}();
!function(e){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=e();else if("function"==typeof define&&define.amd)define([],e);else{var f;"undefined"!=typeof window?f=window:"undefined"!=typeof global?f=global:"undefined"!=typeof self&&(f=self),f.TreeModel=e()}}(function(){var define,module,exports;return (function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var mergeSort, findInsertIndex;
mergeSort = require('mergesort');
findInsertIndex = require('find-insert-index');

module.exports = (function () {
  'use strict';

  var walkStrategies;

  walkStrategies = {};

  function TreeModel(config) {
    config = config || {};
    this.config = config;
    this.config.childrenPropertyName = config.childrenPropertyName || 'children';
    this.config.modelComparatorFn = config.modelComparatorFn;
  }

  TreeModel.prototype.parse = function (model) {
    var i, childCount, node;

    if (!(model instanceof Object)) {
      throw new TypeError('Model must be of type object.');
    }

    node = new Node(this.config, model);
    if (model[this.config.childrenPropertyName] instanceof Array) {
      if (this.config.modelComparatorFn) {
        model[this.config.childrenPropertyName] = mergeSort(
          this.config.modelComparatorFn,
          model[this.config.childrenPropertyName]);
      }
      for (i = 0, childCount = model[this.config.childrenPropertyName].length; i < childCount; i++) {
        _addChildToNode(node, this.parse(model[this.config.childrenPropertyName][i]));
      }
    }
    return node;
  };

  function _addChildToNode(node, child) {
    child.parent = node;
    node.children.push(child);
    return child;
  }

  function Node(config, model) {
    this.config = config;
    this.model = model;
    this.children = [];
  }

  Node.prototype.isRoot = function () {
    return this.parent === undefined;
  };

  Node.prototype.isLeaf = function () {
    return this.children.length == 0;
  };


  Node.prototype.hasChildren = function () {
    return this.children.length > 0;
  };

  Node.prototype.addChild = function (child) {
    var index;

    if (!(child instanceof Node)) {
      throw new TypeError('Child must be of type Node.');
    }

    child.parent = this;
    if (!(this.model[this.config.childrenPropertyName] instanceof Array)) {
      this.model[this.config.childrenPropertyName] = [];
    }

    if (this.config.modelComparatorFn) {
      // Find the index to insert the child
      index = findInsertIndex(
        this.config.modelComparatorFn,
        this.model[this.config.childrenPropertyName],
        child.model);
      // Add to the model children
      this.model[this.config.childrenPropertyName].splice(index, 0, child.model);
      // Add to the node children
      this.children.splice(index, 0, child);
    } else {
      this.model[this.config.childrenPropertyName].push(child.model);
      this.children.push(child);
    }
    return child;
  };

  Node.prototype.getPath = function () {
    var path = [];
    (function addToPath(node) {
      path.unshift(node);
      if (!node.isRoot()) {
        addToPath(node.parent);
      }
    })(this);
    return path;
  };

  /**
   * Parse the arguments of traversal functions. These functions can take one optional
   * first argument which is an options object. If present, this object will be stored
   * in args.options. The only mandatory argument is the callback function which can
   * appear in the first or second position (if an options object is given). This
   * function will be saved to args.fn. The last optional argument is the context on
   * which the callback function will be called. It will be available in args.ctx.
   *
   * @returns Parsed arguments.
   */
  function parseArgs() {
    var args = {};
    if (arguments.length === 1) {
      args.fn = arguments[0];
    } else if (arguments.length === 2) {
      if (typeof arguments[0] === 'function') {
        args.fn = arguments[0];
        args.ctx = arguments[1];
      } else {
        args.options = arguments[0];
        args.fn = arguments[1];
      }
    } else {
      args.options = arguments[0];
      args.fn = arguments[1];
      args.ctx = arguments[2];
    }
    args.options = args.options || {};
    if (!args.options.strategy) {
      args.options.strategy = 'pre';
    }
    if (!walkStrategies[args.options.strategy]) {
      throw new Error('Unknown tree walk strategy. Valid strategies are \'pre\' [default], \'post\' and \'breadth\'.');
    }
    return args;
  }

  Node.prototype.walk = function () {
    var args;
    args = parseArgs.apply(this, arguments);
    walkStrategies[args.options.strategy].call(this, args.fn, args.ctx);
  };

  walkStrategies.pre = function depthFirstPreOrder(callback, context) {
    var i, childCount, keepGoing;
    keepGoing = callback.call(context, this);
    for (i = 0, childCount = this.children.length; i < childCount; i++) {
      if (keepGoing === false) {
        return false;
      }
      keepGoing = depthFirstPreOrder.call(this.children[i], callback, context);
    }
    return keepGoing;
  };

  walkStrategies.post = function depthFirstPostOrder(callback, context) {
    var i, childCount, keepGoing;
    for (i = 0, childCount = this.children.length; i < childCount; i++) {
      keepGoing = depthFirstPostOrder.call(this.children[i], callback, context);
      if (keepGoing === false) {
        return false;
      }
    }
    keepGoing = callback.call(context, this);
    return keepGoing;
  };

  walkStrategies.breadth = function breadthFirst(callback, context) {
    var queue = [this];
    (function processQueue() {
      var i, childCount, node;
      if (queue.length === 0) {
        return;
      }
      node = queue.shift();
      for (i = 0, childCount = node.children.length; i < childCount; i++) {
        queue.push(node.children[i]);
      }
      if (callback.call(context, node) !== false) {
        processQueue();
      }
    })();
  };

  Node.prototype.all = function () {
    var args, all = [];
    args = parseArgs.apply(this, arguments);
    walkStrategies[args.options.strategy].call(this, function (node) {
      if (args.fn.call(args.ctx, node)) {
        all.push(node);
      }
    }, args.ctx);
    return all;
  };

  Node.prototype.first = function () {
    var args, first;
    args = parseArgs.apply(this, arguments);
    walkStrategies[args.options.strategy].call(this, function (node) {
      if (args.fn.call(args.ctx, node)) {
        first = node;
        return false;
      }
    }, args.ctx);
    return first;
  };

  Node.prototype.leaves = function () {
    return this.all(function (node) { return node.isLeaf() });
  };

  Node.prototype.drop = function () {
    var indexOfChild;
    if (!this.isRoot()) {
      indexOfChild = this.parent.children.indexOf(this);
      this.parent.children.splice(indexOfChild, 1);
      this.parent.model[this.config.childrenPropertyName].splice(indexOfChild, 1);
      this.parent = undefined;
      delete this.parent;
    }
    return this;
  };

  return TreeModel;
})();

},{"find-insert-index":2,"mergesort":3}],2:[function(require,module,exports){
module.exports = (function () {
  'use strict';

  /**
   * Find the index to insert an element in array keeping the sort order.
   *
   * @param {function} comparatorFn The comparator function which sorted the array.
   * @param {array} arr The sorted array.
   * @param {object} el The element to insert.
   */
  function findInsertIndex(comparatorFn, arr, el) {
    var i, len;
    for (i = 0, len = arr.length; i < len; i++) {
      if (comparatorFn(arr[i], el) > 0) {
        break;
      }
    }
    return i;
  }

  return findInsertIndex;
})();

},{}],3:[function(require,module,exports){
module.exports = (function () {
  'use strict';

  /**
   * Sort an array using the merge sort algorithm.
   *
   * @param {function} comparatorFn The comparator function.
   * @param {array} arr The array to sort.
   * @returns {array} The sorted array.
   */
  function mergeSort(comparatorFn, arr) {
    var len = arr.length, firstHalf, secondHalf;
    if (len >= 2) {
      firstHalf = arr.slice(0, len / 2);
      secondHalf = arr.slice(len / 2, len);
      return merge(comparatorFn, mergeSort(comparatorFn, firstHalf), mergeSort(comparatorFn, secondHalf));
    } else {
      return arr.slice();
    }
  }

  /**
   * The merge part of the merge sort algorithm.
   *
   * @param {function} comparatorFn The comparator function.
   * @param {array} arr1 The first sorted array.
   * @param {array} arr2 The second sorted array.
   * @returns {array} The merged and sorted array.
   */
  function merge(comparatorFn, arr1, arr2) {
    var result = [], left1 = arr1.length, left2 = arr2.length;
    while (left1 > 0 && left2 > 0) {
      if (comparatorFn(arr1[0], arr2[0]) <= 0) {
        result.push(arr1.shift());
        left1--;
      } else {
        result.push(arr2.shift());
        left2--;
      }
    }
    if (left1 > 0) {
      result.push.apply(result, arr1);
    } else {
      result.push.apply(result, arr2);
    }
    return result;
  }

  return mergeSort;
})();

},{}]},{},[1])(1)
});
(function() {
  angular.module('sectirTableModule.groupinput', ['sectirTableModule.dataFactory', 'ngTagsInput']).directive('sectirGroupInput', [
    "sectirDataFactory", "$compile", function(sectirDataFactory, $compile) {
      var defaultValues;
      defaultValues = {
        namespace: "default",
        debugmodel: false,
        typefield: "type",
        namefield: "name",
        optionsfield: "options"
      };
      return {
        restrict: "EA",
        scope: {
          namespace: "=?",
          tabledata: "=",
          namefield: "=?",
          typefield: "=?",
          debugmodel: "=?",
          optionsfield: "=?",
          scopedata: "="
        },
        link: function(scope, element, attrs, ctrl) {
          var linkFn;
          scope.answersObject = {};
          linkFn = function() {
            var cellWithInput, currObjName, elm, elmDebug, elmName, elmWrapper, key, type, val, value, wrapTable, _i, _len, _ref, _ref1;
            for (key in defaultValues) {
              value = defaultValues[key];
              if (!angular.isDefined(scope[key])) {
                scope[key] = value;
              }
            }
            wrapTable = angular.element("<table>");
            wrapTable.addClass("sectir-groupinput-main");
            _ref = scope.scopedata;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
              val = _ref[_i];
              currObjName = "answersObject['" + val.id + "']";
              elmWrapper = angular.element("<tr>");
              elmWrapper.addClass("sectir-groupinput-wrapper");
              elmName = angular.element("<td>");
              elmName.addClass("sectir-groupinput-namefield");
              elmName.text(val[scope.namefield]);
              type = (function() {
                switch (val[scope.typefield]) {
                  case "select":
                    return "select";
                  case "tag-input":
                  case "tags-input":
                    return "tags-input";
                  default:
                    return "input";
                }
              })();
              elm = angular.element("<" + type + ">");
              if (type === "input") {
                elm.attr("type", val[scope.typefield]);
              }
              elm.attr("ng-model", currObjName);
              if (angular.isDefined(val[scope.optionsfield])) {
                _ref1 = val[scope.optionsfield];
                for (key in _ref1) {
                  value = _ref1[key];
                  elm.attr(key, value);
                }
              }
              elmWrapper.append(elmName);
              cellWithInput = angular.element("<td>");
              cellWithInput.addClass("sectir-groupinput-cell");
              cellWithInput.append(elm);
              elmWrapper.append(cellWithInput);
              if (scope.debugmodel) {
                elmDebug = angular.element("<td>");
                elmDebug.text("{{" + currObjName + "}}");
                elmWrapper.append(elmDebug);
              }
              wrapTable.append(elmWrapper);
            }
            $compile(wrapTable)(scope);
            element.append(wrapTable);
          };
          linkFn();
          return scope.$watch("answersObject", function() {
            console.log("Guardando datos");
            return sectirDataFactory.saveData(scope.answersObject, scope.namespace);
          }, true);
        }
      };
    }
  ]);

}).call(this);

(function() {
  angular.module('sectirTableModule.input', ['sectirTableModule.dataFactory', 'ngTagsInput']).directive('sectirInput', [
    "sectirDataFactory", "$compile", function(sectirDataFactory, $compile) {
      var defaultValues;
      defaultValues = {
        namespace: "default",
        debugmodel: false,
        typefield: "type",
        namefield: "name",
        optionsfield: "options"
      };
      return {
        restrict: "EA",
        scope: {
          namespace: "=?",
          typefield: "=?",
          debugmodel: "=?",
          namefield: "=?",
          optionsfield: "=?",
          scopedata: "="
        },
        link: function(scope, element, attrs, ctrl) {
          var linkFn, watchFn;
          linkFn = function() {
            var currObjectName, divInput, elm, elmDebug, elmName, elmWrapper, key, type, val, value, wrapDiv, _i, _len, _ref, _ref1;
            for (key in defaultValues) {
              value = defaultValues[key];
              if (!angular.isDefined(scope[key])) {
                scope[key] = value;
              }
            }
            wrapDiv = angular.element("<div>");
            wrapDiv.addClass("sectir-input-main");
            _ref = scope.scopedata;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
              val = _ref[_i];
              currObjectName = "answersObject['" + val.id + "']";
              elmWrapper = angular.element("<div>");
              elmWrapper.addClass("sectir-input-wrapper");
              elmName = angular.element("<div>");
              elmName.addClass("sectir-input-namefield");
              elmName.text(val[scope.namefield]);
              type = (function() {
                switch (val[scope.typefield]) {
                  case "select":
                    return "select";
                  case "tag-input":
                  case "tags-input":
                    return "tags-input";
                  default:
                    return "input";
                }
              })();
              divInput = angular.element("<div>");
              divInput.addClass("sectir-input-input");
              elm = angular.element("<" + type + ">");
              if (type === "input") {
                elm.attr("type", val[scope.typefield]);
              }
              elm.attr("ng-model", currObjectName);
              divInput.append(elm);
              if (angular.isDefined(val[scope.optionsfield])) {
                _ref1 = val[scope.optionsfield];
                for (key in _ref1) {
                  value = _ref1[key];
                  elm.attr(key, value);
                }
              }
              elmWrapper.append(elmName);
              elmWrapper.append(divInput);
              if (scope.debugmodel) {
                elmDebug = angular.element("<div>");
                elmDebug.text("{{" + currObjectName + "}}");
                elmWrapper.append(elmDebug);
              }
              wrapDiv.append(elmWrapper);
            }
            scope.answersObject = {};
            $compile(wrapDiv)(scope);
            return element.append(wrapDiv);
          };
          watchFn = function() {
            return [scope.namespace, scope.scopedata];
          };
          linkFn();
          return scope.$watch("answersObject", function() {
            console.log("Guardando datos");
            return sectirDataFactory.saveData(scope.answersObject, scope.namespace);
          }, true);
        }
      };
    }
  ]);

}).call(this);

(function() {
  angular.module('sectirTableModule.pager', ['sectirTableModule.dataFactory', 'sectirTableModule.input', 'sectirTableModule.table', 'sectirTableModule.groupinput']).directive('sectirPager', [
    "$compile", function($compile) {
      return {
        restrict: "EA",
        scope: {
          values: "=",
          settings: "=?",
          finalizefunc: "&"
        },
        controller: [
          "$scope", function($scope) {
            $scope.currPos = 0;
            $scope.nextButtonClick = function() {
              if ($scope.isNextButtonClickable()) {
                $scope.currPos++;
              }
            };
            $scope.prevButtonClick = function() {
              if ($scope.isPrevButtonClickable()) {
                --$scope.currPos;
              }
            };
            $scope.isPrevButtonClickable = function() {
              return $scope.currPos > 0;
            };
            $scope.isNextButtonClickable = function() {
              return $scope.currPos < ($scope.values.length - 1);
            };
            $scope.isFinalizeButtonClickable = function() {
              return $scope.finalizefunc && $scope.currPos === ($scope.values.length - 1);
            };
            $scope.nextButtonText = "Siguiente";
            $scope.prevButtonText = "Anterior";
            return $scope.finalizeButtonText = "Finalizar";
          }
        ],
        link: function(scope, element, attrs, ctrl) {
          var buttonDivRow, buttonFinal, buttonNext, buttonPrev, directive, divContainer, divWholeContainer, i, isSettingsDefined, key, myValues, t, val, valueVariable, _i, _j, _len, _len1, _ref;
          myValues = angular.copy(scope.values);
          divWholeContainer = angular.element("<div>");
          divWholeContainer.addClass("sectir-pager-wholecontainer");
          isSettingsDefined = {};
          isSettingsDefined["all"] = angular.isDefined(scope.settings);
          _ref = ["input", "table", "groupinput"];
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            t = _ref[_i];
            isSettingsDefined[t] = isSettingsDefined["all"] && angular.isDefined(scope.settings[t]);
          }
          for (i = _j = 0, _len1 = myValues.length; _j < _len1; i = ++_j) {
            val = myValues[i];
            divContainer = angular.element("<div>");
            divContainer.addClass("sectir-pager-container");
            switch (val.type) {
              case "input":
                directive = angular.element("<sectir-input>");
                break;
              case "table":
                directive = angular.element("<sectir-table>");
                break;
              case "groupinput":
                directive = angular.element("<sectir-group-input>");
                break;
              default:
                throw new Error('Type must be input, table\nor group-input');
            }
            if (isSettingsDefined[val.type]) {
              for (key in scope.settings[val.type]) {
                directive.attr(key, "settings." + val.type + "." + key);
              }
            }
            valueVariable = (function() {
              switch (val.type) {
                case "input":
                case "groupinput":
                  return "scopedata";
                case "table":
                  return "tabledata";
                default:
                  return "";
              }
            })();
            directive.attr(valueVariable, "values[" + i + "].values");
            directive.attr("namespace", "values[" + i + "].namespace");
            divContainer.attr("ng-show", "currPos === " + i);
            divContainer.append(directive);
            divWholeContainer.append(divContainer);
          }
          buttonDivRow = angular.element("<div>");
          buttonDivRow.addClass("sectir-pager-button-row");
          buttonPrev = angular.element("<button>");
          buttonPrev.addClass("sectir-pager-prev-button");
          buttonPrev.text("{{ prevButtonText }}");
          buttonPrev.attr("ng-click", "prevButtonClick()");
          buttonPrev.attr("ng-disabled", "!isPrevButtonClickable()");
          buttonNext = angular.element("<button>");
          buttonNext.addClass("sectir-pager-next-button");
          buttonNext.text("{{ nextButtonText }}");
          buttonNext.attr("ng-click", "nextButtonClick()");
          buttonNext.attr("ng-disabled", "!isNextButtonClickable()");
          buttonFinal = angular.element("<button>");
          buttonFinal.addClass("sectir-pager-final-button");
          buttonFinal.text("{{ finalizeButtonText }}");
          buttonFinal.attr("ng-click", "finalizefunc()");
          buttonFinal.attr("ng-disabled", "!isFinalizeButtonClickable()");
          buttonDivRow.append(buttonPrev);
          buttonDivRow.append(buttonNext);
          buttonDivRow.append(buttonFinal);
          divWholeContainer.append(buttonDivRow);
          $compile(divWholeContainer)(scope);
          return element.append(divWholeContainer);
        }
      };
    }
  ]);

}).call(this);

(function() {
  angular.module('sectirTableModule.table', ['sectirTableModule.treeFactory', 'sectirTableModule.treeModelFactory', 'sectirTableModule.dataFactory', 'ngTagsInput']).directive('sectirTable', [
    "sectirTreeFactory", "sectirDataFactory", "treeModelFactory", "$compile", function(sectirTreeFactory, sectirDataFactory, treeModelFactory, $compile) {
      var defaultValues;
      defaultValues = {
        namespace: "default",
        deletefieldlabel: "Delete",
        debugmodel: false,
        deletelabel: "Delete",
        typefield: "type",
        titlefield: "name",
        optionsfield: "options",
        addlabel: "Add",
        addfieldlabel: "Add",
        subquestions: false,
        subqenun: "enunciado",
        anocomienzo: false,
        anofinal: false
      };
      return {
        restrict: "EA",
        scope: {
          namespace: "=?",
          tabledata: "=",
          titlefield: "=?",
          deletelabel: "=?",
          deletefieldlabel: "=?",
          addfieldlabel: "=?",
          addlabel: "=?",
          typefield: "=?",
          debugmodel: "=?",
          optionsfield: "=?",
          subquestions: "=?",
          subqenun: "=?",
          anocomienzo: "=?",
          anofinal: "=?"
        },
        controller: [
          "$scope", function($scope) {
            var key, value;
            for (key in defaultValues) {
              value = defaultValues[key];
              if (!angular.isDefined($scope[key])) {
                $scope[key] = value;
              }
            }
            $scope.answersObject = {};
            $scope.needObject = function() {
              var aTree, first, subQFn;
              subQFn = function(node) {
                return node.model[$scope.typefield] === "subq";
              };
              aTree = treeModelFactory.parse($scope.tabledata);
              first = aTree.first(subQFn);
              return $scope.subquestions instanceof Array || first;
            };
            if (!$scope.needObject()) {
              $scope.answersIsArray = true;
              $scope.answersObject.hasSubQ = false;
              $scope.answersObject.values = [];
            } else {
              $scope.answersIsArray = false;
              $scope.answersObject.hasSubQ = true;
              $scope.answersObject.values = {};
            }
            $scope.addAnswer = function() {
              if ($scope.answersIsArray) {
                return $scope.answersObject.values.push({});
              }
            };
            $scope.deleteAnswer = function(index) {
              $scope.answersObject.values.splice(index, 1);
              if ($scope.answersObject.values.length < 1) {
                return $scope.addAnswer();
              }
            };
            return $scope.subqtitle = "Opciones";
          }
        ],
        link: function(scope, element, attrs, ctrl) {
          var linkFn, watchFn;
          linkFn = function() {
            var dropRefactorFn, elm, elmAdd, field, firstRow, forEachRefactorFn, haveSubQuestions, headers, ngModelRow, remainingTable, row, rows, rowspan, spanAddLabel, spanDeleteLabel, subQ, subQNodes, table, templateAnswers, templateAnswersFn, tr, trRows, treeHeight, treeToBeRefactored, val, _i, _j, _k, _l, _len, _len1, _len2, _len3, _len4, _m, _ref;
            sectirTreeFactory.addTree(scope.tabledata, scope.namespace, scope.titlefield, scope.typefield);
            treeToBeRefactored = sectirTreeFactory.trees[scope.namespace];
            console.log(treeToBeRefactored);
            subQNodes = [];
            dropRefactorFn = function(node) {
              return node.model[scope.typefield] === "subq";
            };
            forEachRefactorFn = function(node) {
              node.drop();
              return subQNodes = subQNodes.concat(node.model.subq);
            };
            treeToBeRefactored.all(dropRefactorFn).forEach(forEachRefactorFn);
            if (subQNodes.length) {
              scope.subquestions = subQNodes;
            }
            haveSubQuestions = scope.subquestions || subQNodes.length;
            sectirTreeFactory.addTree(scope.tabledata, scope.namespace, scope.titlefield, scope.typefield, scope.anocomienzo, scope.anofinal);
            rows = sectirTreeFactory.getRows(scope.namespace);
            remainingTable = element.find("table");
            if (angular.isElement(remainingTable)) {
              remainingTable.remove();
            }
            table = angular.element("<table>");
            table.addClass("sectir-table");
            firstRow = true;
            trRows = [];
            for (_i = 0, _len = rows.length; _i < _len; _i++) {
              row = rows[_i];
              headers = [];
              tr = angular.element("<tr>");
              tr.addClass("sectir-table-header");
              for (_j = 0, _len1 = row.length; _j < _len1; _j++) {
                field = row[_j];
                elm = angular.element("<th>");
                elm.text(field.model[scope.titlefield]);
                elm.addClass("sectir-header");
                elm.attr("colspan", sectirTreeFactory.getNumberLeafsFromNode(field.model.id, scope.namespace));
                rowspan = (function() {
                  var hasChildren;
                  hasChildren = sectirTreeFactory.hasChildrenById(field.model.id, scope.namespace);
                  if (!hasChildren) {
                    return sectirTreeFactory.getNodeLevelsFromMax(field.model.id, scope.namespace) + 1;
                  } else {
                    return 1;
                  }
                })();
                elm.attr("rowspan", rowspan);
                headers.push(elm);
              }
              if (firstRow) {
                firstRow = false;
                treeHeight = sectirTreeFactory.getTreeHeight(scope.namespace);
                if (!haveSubQuestions) {
                  elm = angular.element("<th>");
                  elm.addClass("sectir-delete");
                  spanDeleteLabel = angular.element("<span>");
                  spanDeleteLabel.text("{{ deletelabel }}");
                  elm.append(spanDeleteLabel);
                  elm.attr("colspan", 1);
                  elm.attr("rowspan", treeHeight);
                  elmAdd = angular.element("<th>");
                  elmAdd.addClass("sectir-add");
                  spanAddLabel = angular.element("<span>");
                  spanAddLabel.text("{{ addlabel }}");
                  elmAdd.append(spanAddLabel);
                  elmAdd.attr("colspan", 1);
                  elmAdd.attr("rowspan", treeHeight);
                  headers.push(elmAdd);
                  headers.push(elm);
                } else {
                  elm = angular.element("<th>");
                  elm.addClass("sectir-subq-title");
                  elm.text("{{subqtitle}}");
                  elm.attr("colspan", 1);
                  elm.attr("rowspan", treeHeight);
                  headers.unshift(elm);
                }
              }
              for (_k = 0, _len2 = headers.length; _k < _len2; _k++) {
                val = headers[_k];
                tr.append(val);
              }
              trRows.push(tr);
            }
            for (_l = 0, _len3 = trRows.length; _l < _len3; _l++) {
              val = trRows[_l];
              table.append(val);
            }
            ngModelRow = function(modelId, subQID) {
              var temp;
              if (subQID == null) {
                subQID = false;
              }
              temp = "answersObject.values";
              if (subQID === false) {
                temp += "[$index]";
              }
              temp += "['" + modelId + "']";
              if (subQID !== false) {
                temp += "['" + subQID + "']";
              }
              return temp;
            };
            templateAnswersFn = function(subQuestion) {
              var addButton, deleteButton, insertHeaders, leafs, leafsByPre, rowRepeat, spanAdd, spanDelete;
              if (subQuestion == null) {
                subQuestion = false;
              }
              leafs = sectirTreeFactory.getLeafs(scope.namespace);
              rowRepeat = angular.element("<tr>");
              if (subQuestion === false) {
                rowRepeat.attr("ng-repeat", "ans in answersObject.values");
              }
              rowRepeat.addClass("sectir-ans-row");
              leafsByPre = sectirTreeFactory.getLeafs(scope.namespace, "pre");
              insertHeaders = function() {
                var headerRepeat, headerSubQ, iEl, input, key, l, options, rowModel, typefieldDefined, value, _len4, _m;
                if (subQuestion) {
                  headerSubQ = angular.element("<th>");
                  headerSubQ.text(subQuestion[scope.subqenun]);
                  headerSubQ.addClass("sectir-table-subq");
                  rowRepeat.append(headerSubQ);
                }
                for (_m = 0, _len4 = leafsByPre.length; _m < _len4; _m++) {
                  l = leafsByPre[_m];
                  headerRepeat = angular.element("<th>");
                  headerRepeat.addClass("sectir-answer");
                  if (!haveSubQuestions) {
                    rowModel = ngModelRow(l.model.id);
                  } else {
                    rowModel = ngModelRow(l.model.id, subQuestion.id);
                  }
                  typefieldDefined = angular.isDefined(l.model[scope.typefield]);
                  if (typefieldDefined) {
                    switch (l.model[scope.typefield]) {
                      case "select":
                        input = angular.element("<select>");
                        break;
                      case "tag-input":
                      case "tags-input":
                        input = angular.element("<tags-input>");
                        break;
                      default:
                        input = angular.element("<input>");
                    }
                  } else {
                    input = angular.element("<input>");
                  }
                  input.attr("ng-model", rowModel);
                  if (typefieldDefined) {
                    input.attr("type", l.model[scope.typefield]);
                  }
                  if (angular.isDefined) {
                    l.model[scope.optionsfield];
                    options = l.model[scope.optionsfield];
                    for (key in options) {
                      value = options[key];
                      input.attr(key, value);
                    }
                  }
                  if (scope.debugmodel) {
                    iEl = angular.element("<i>");
                    iEl.addClass("sectir-debug-model");
                    iEl.text("{{ " + rowModel + " }}");
                  }
                  headerRepeat.append(input);
                  if (scope.debugmodel) {
                    headerRepeat.append(iEl);
                  }
                  rowRepeat.append(headerRepeat);
                }
              };
              insertHeaders();
              if (!haveSubQuestions) {
                deleteButton = angular.element("<th>");
                deleteButton.addClass("sectir-button-delete");
                spanDelete = angular.element("<span>");
                spanDelete.attr("ng-click", "deleteAnswer($index)");
                spanDelete.text("{{ deletefieldlabel }}");
                deleteButton.append(spanDelete);
                addButton = angular.element("<th>");
                addButton.addClass("sectir-button-add");
                spanAdd = angular.element("<span>");
                spanAdd.attr("ng-click", "addAnswer()");
                spanAdd.text("{{ addfieldlabel }}");
                addButton.append(spanAdd);
                rowRepeat.append(addButton);
                rowRepeat.append(deleteButton);
              }
              return rowRepeat;
            };
            if (!haveSubQuestions) {
              templateAnswers = templateAnswersFn();
              table.append(templateAnswers);
            } else {
              _ref = scope.subquestions;
              for (_m = 0, _len4 = _ref.length; _m < _len4; _m++) {
                subQ = _ref[_m];
                templateAnswers = templateAnswersFn(subQ);
                table.append(templateAnswers);
              }
            }
            $compile(table)(scope);
            element.append(table);
            if (!haveSubQuestions) {
              return scope.addAnswer();
            }
          };
          watchFn = function() {
            return [scope.namespace, scope.tabledata];
          };
          linkFn();
          return scope.$watch("answersObject", function() {
            console.log("Guardando datos");
            return sectirDataFactory.saveData(scope.answersObject, scope.namespace);
          }, true);
        }
      };
    }
  ]);

}).call(this);

(function() {
  angular.module('sectirTableModule.dataFactory', []).factory('sectirDataFactory', function() {
    var SectirDataFactory;
    return new (SectirDataFactory = (function() {
      function SectirDataFactory() {
        this.data = {};
      }

      SectirDataFactory.prototype.saveData = function(data, namespace) {
        if (namespace == null) {
          namespace = "default";
        }
        return this.data[namespace] = data;
      };

      SectirDataFactory.prototype.getData = function(namespace) {
        if (namespace == null) {
          namespace = "default";
        }
        return this.data[namespace];
      };

      return SectirDataFactory;

    })());
  });

}).call(this);

(function() {
  var sectirTreeFactoryModule;

  sectirTreeFactoryModule = angular.module('sectirTableModule.treeFactory', ['sectirTableModule.treeModelFactory']);

  sectirTreeFactoryModule.factory('sectirTreeFactory', [
    "treeModelFactory", function(treeM) {
      var SectirTreeFactory;
      return new (SectirTreeFactory = (function() {
        function SectirTreeFactory() {
          this.trees = {};
          this.maxHeights = {};
          this.nodesById = {};
        }

        SectirTreeFactory.prototype.reset = function() {
          this.trees = {};
          this.maxHeights = {};
          return this.nodesById = {};
        };

        SectirTreeFactory.prototype.addTree = function(tree, namespace, namefield, typeField, anoComienzo, anoFinal) {
          var ano, anoInput, n, nodeAnoInput, nodos, treeParsed, _i, _j, _len;
          if (namespace == null) {
            namespace = "default";
          }
          if (namefield == null) {
            namefield = "name";
          }
          if (typeField == null) {
            typeField = "type";
          }
          if (anoComienzo == null) {
            anoComienzo = false;
          }
          if (anoFinal == null) {
            anoFinal = false;
          }
          treeParsed = treeM.parse(tree);
          if (anoComienzo || anoFinal) {
            nodos = treeParsed.all(function(node) {
              return node.model[typeField] === "ano";
            });
            for (_i = 0, _len = nodos.length; _i < _len; _i++) {
              n = nodos[_i];
              for (ano = _j = anoComienzo; _j <= anoFinal; ano = _j += 1) {
                anoInput = {};
                anoInput.id = "" + n.model.id + "-" + ano;
                anoInput[typeField] = "number";
                anoInput[namefield] = "" + ano;
                nodeAnoInput = treeM.parse(anoInput);
                n.addChild(nodeAnoInput);
              }
            }
          }
          this.trees[namespace] = treeParsed;
          this.maxHeights[namespace] = void 0;
          this.nodesById[namespace] = {};
        };

        SectirTreeFactory.prototype.getTreeHeight = function(namespace) {
          var retVal;
          if (namespace == null) {
            namespace = "default";
          }
          if (this.maxHeights[namespace] != null) {
            return this.maxHeights[namespace];
          }
          retVal = 0;
          this.trees[namespace].walk(function(node) {
            var level;
            level = node.getPath().length;
            if (level > retVal) {
              retVal = level;
            }
          });
          return this.maxHeights[namespace] = retVal;
        };

        SectirTreeFactory.prototype.getNodeHeightById = function(id, namespace) {
          var val;
          if (namespace == null) {
            namespace = "default";
          }
          val = this.getNodeById(id, namespace);
          if (val) {
            return val.getPath().length;
          } else {
            return false;
          }
        };

        SectirTreeFactory.prototype.getNodeById = function(id, namespace) {
          var retVal, _ref;
          if (namespace == null) {
            namespace = "default";
          }
          if (this.trees[namespace] == null) {
            return false;
          }
          if (this.nodesById[namespace][id] != null) {
            return this.nodesById[namespace][id];
          }
          id = String(id);
          retVal = false;
          if ((_ref = this.trees[namespace]) != null) {
            _ref.walk(function(node) {
              var modelId;
              modelId = String(node.model.id);
              if (modelId === id) {
                retVal = node;
                return false;
              }
            });
          }
          return this.nodesById[namespace][id] = retVal;
        };

        SectirTreeFactory.prototype.hasChildren = function(node) {
          return (node.children != null) && node.children.length > 0;
        };

        SectirTreeFactory.prototype.hasChildrenById = function(id, namespace) {
          if (namespace == null) {
            namespace = "default";
          }
          return this.hasChildren(this.getNodeById(id, namespace));
        };

        SectirTreeFactory.prototype.getLeafs = function(namespace, st) {
          var retVal, self, strategy;
          if (namespace == null) {
            namespace = "default";
          }
          if (st == null) {
            st = "breadth";
          }
          strategy = {
            strategy: st
          };
          self = this;
          retVal = this.trees[namespace] != null ? this.trees[namespace].all(strategy, function(node) {
            return !self.hasChildren(node);
          }) : false;
          return retVal;
        };

        SectirTreeFactory.prototype.getRows = function(namespace) {
          var curLevel, retVal, self, strategy;
          if (namespace == null) {
            namespace = "default";
          }
          strategy = {
            strategy: 'breadth'
          };
          retVal = [];
          curLevel = -1;
          self = this;
          this.trees[namespace].walk(strategy, function(node) {
            var nodeHeight;
            nodeHeight = self.getNodeHeightById(node.model.id, namespace);
            if (nodeHeight !== curLevel) {
              retVal.push([]);
              curLevel = nodeHeight;
            }
            retVal[curLevel - 1].push(node);
          });
          return retVal;
        };

        SectirTreeFactory.prototype.getNodeLevelsFromMax = function(id, namespace) {
          var node;
          if (namespace == null) {
            namespace = "default";
          }
          node = this.getNodeById(id, namespace);
          if (node === false) {
            return false;
          }
          return this.getTreeHeight(namespace) - node.getPath().length;
        };

        SectirTreeFactory.prototype.getNumberLeafsFromNode = function(id, namespace) {
          var node, retVal, self;
          if (namespace == null) {
            namespace = "default";
          }
          node = this.getNodeById(id, namespace);
          if (node === false) {
            return false;
          }
          retVal = 0;
          self = this;
          node.walk(function(aNode) {
            if (!self.hasChildren(aNode)) {
              retVal++;
            }
          });
          return retVal;
        };

        return SectirTreeFactory;

      })());
    }
  ]);

}).call(this);

(function() {
  angular.module('sectirTableModule.treeModelFactory', []).factory('treeModelFactory', function() {
    return new TreeModel;
  });

}).call(this);

(function() {
  angular.module('sectirTableModule', ['sectirTableModule.table', 'sectirTableModule.input', 'sectirTableModule.groupinput', 'sectirTableModule.pager', 'sectirTableModule.treeModelFactory']);

}).call(this);

(function() {
  var anoComienzo, anoFinal, sectirRApp, url, urlPost, urlRetorno;

  sectirRApp = angular.module('sectirRespuestaApp', ['sectirTableModule']);

  url = false;

  urlPost = false;

  anoComienzo = false;

  anoFinal = false;

  urlRetorno = false;

  sectirRApp.provider('sectirRespuestaConfigProvider', {
    set: function(data) {
      url = data.url;
      urlPost = data.urlPost;
      anoComienzo = data.anoComienzo;
      anoFinal = data.anoFinal;
      return urlRetorno = data.urlRetorno;
    },
    $get: function() {
      return {
        getURL: function() {
          return url;
        },
        getURLPost: function() {
          return urlPost;
        },
        getURLRetorno: function() {
          return urlRetorno;
        },
        getAnos: function() {
          return {
            anoComienzo: anoComienzo,
            anoFinal: anoFinal
          };
        }
      };
    }
  });

  sectirRApp.directive('sectirApp', [
    "$compile", "sectirDataFactory", function($compile, SDF) {
      var isCompiled;
      isCompiled = false;
      return {
        restrict: "EA",
        controller: [
          "$http", "$scope", "$window", "sectirRespuestaConfigProvider", function($http, $scope, $window, SRC) {
            var successFn, successPostFn;
            $scope.jsonData = false;
            $scope.anos = SRC.getAnos();
            $scope.datos = false;
            successPostFn = function(data, status) {
              var retorno;
              console.log(data);
              console.log(status);
              retorno = SRC.getURLRetorno();
              if (retorno) {
                $window.location.href = retorno;
              }
            };
            $scope.finalFunc = function() {
              var isConfirmed;
              console.log(SDF.data);
              isConfirmed = confirm('¿Desea terminar?\nLa encuesta no podrá volver a ser respondida');
              if (isConfirmed) {
                $http.post(SRC.getURLPost(), SDF.data).success(successPostFn);
              }
            };
            successFn = function(data) {
              var arrayDatos, key, value, _ref;
              $scope.jsonData = data;
              arrayDatos = [];
              _ref = data.data;
              for (key in _ref) {
                value = _ref[key];
                arrayDatos.push(value);
              }
              return $scope.datos = arrayDatos;
            };
            $http.get(SRC.getURL()).then(successFn);
            $scope.settings = {
              table: {
                titlefield: "enunciado",
                typefield: "tipo",
                subqenun: "enunciadocomp"
              },
              input: {
                namefield: "enunciado",
                typefield: "tipo"
              }
            };
            if ($scope.anos) {
              $scope.settings.table.anocomienzo = $scope.anos.anoComienzo;
              $scope.settings.table.anofinal = $scope.anos.anoFinal;
            }
          }
        ],
        link: function(scope, element, attrs, ctrl) {
          var elm, funcCompile;
          elm = angular.element('<div sectir-pager\n    values="datos"\n    finalizeFunc ="finalFunc()"\n    settings = "settings"\n</div>');
          funcCompile = function() {
            var compiled;
            if (!isCompiled && scope.datos) {
              isCompiled = true;
              compiled = $compile(elm)(scope);
              element.append(compiled);
            }
          };
          scope.$watch("datos", funcCompile, true);
        }
      };
    }
  ]);

  window.sectirRApp = sectirRApp;

}).call(this);
