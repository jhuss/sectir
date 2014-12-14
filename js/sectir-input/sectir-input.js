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
  angular.module('sectirTableModule.groupinput', ['sectirTableModule.dataFactory']).directive('sectirGroupInput', [
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
              type = val[scope.typefield] === "select" ? "select" : "input";
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
  angular.module('sectirTableModule.input', ['sectirTableModule.dataFactory']).directive('sectirInput', [
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
              type = val[scope.typefield] === "select" ? "select" : "input";
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
  angular.module('sectirTableModule.table', ['sectirTableModule.treeFactory', 'sectirTableModule.treeModelFactory', 'sectirTableModule.dataFactory']).directive('sectirTable', [
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
            $scope.answersObject = {};
            if (!$scope.subquestions) {
              $scope.answersObject.values = [];
            }
            $scope.addAnswer = function() {
              return $scope.answersObject.values.push({});
            };
            $scope.deleteAnswer = function(index) {
              $scope.answersObject.values.splice(index, 1);
              if ($scope.answersObject.values.length < 1) {
                return $scope.addAnswer();
              }
            };
            $scope.haveSubQuestions = function() {
              return $scope.subquestions instanceof Array;
            };
            return $scope.subqtitle = "Opciones";
          }
        ],
        link: function(scope, element, attrs, ctrl) {
          var linkFn, watchFn;
          linkFn = function() {
            var dropRefactorFn, elm, elmAdd, field, firstRow, forEachRefactorFn, haveSubQuestions, headers, key, ngModelRow, remainingTable, row, rows, rowspan, spanAddLabel, spanDeleteLabel, subQ, subQNodes, table, templateAnswers, templateAnswersFn, tr, trRows, treeHeight, treeToBeRefactored, val, value, _i, _j, _k, _l, _len, _len1, _len2, _len3, _len4, _m, _ref;
            for (key in defaultValues) {
              value = defaultValues[key];
              if (!angular.isDefined(scope[key])) {
                scope[key] = value;
              }
            }
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
            rows = sectirTreeFactory.getRows(scope.namespace);
            haveSubQuestions = scope.haveSubQuestions() || subQNodes.length;
            sectirTreeFactory.addTree(scope.tabledata, scope.namespace, scope.titlefield, scope.typefield, scope.anocomienzo, scope.anofinal);
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
                var headerRepeat, headerSubQ, iEl, input, l, options, rowModel, typefieldDefined, _len4, _m;
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
                  if (typefieldDefined && l.model[scope.typefield] === "select") {
                    input = angular.element("<select>");
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
  var sectirRApp, url;

  sectirRApp = angular.module('sectirRespuestaApp', ['sectirTableModule']);

  url = false;

  sectirRApp.provider('sectirRespuestaConfigProvider', {
    set: function(myURL) {
      return url = myURL;
    },
    $get: function() {
      return {
        getURL: function() {
          return url;
        }
      };
    }
  });

  sectirRApp.directive('sectirApp', [
    "$compile", function($compile) {
      var isCompiled;
      isCompiled = false;
      return {
        restrict: "EA",
        controller: [
          "$http", "$scope", "sectirRespuestaConfigProvider", function($http, $scope, SRC) {
            var successFn;
            $scope.jsonData = false;
            $scope.datos = false;
            $scope.finalFunc = function() {};
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
          }
        ],
        link: function(scope, element, attrs, ctrl) {
          var elm, funcCompile;
          elm = angular.element('<div sectir-pager\n    values="datos"\n    finalizeFunc ="finalFunc"\n    settings = "settings"\n</div>');
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
