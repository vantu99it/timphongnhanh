/**
 * Quy ước class:
 * - Class cha chứa thẻ input: form-group
 * - Class thẻ hiện lỗi : form-mesage --> <span class="form-message"></span>
 */

// Đối tượng , hàm
function Validator(formSelector) {
  // Lấy thẻ cha chưa input
  function getParent(element, selector) {
    while (element.parentElement) {
      if (element.parentElement.matches(selector)) {
        return element.parentElement;
      }
      element = element.parentElement;
    }
  }

  var formRules = {};
  /**
   * Quy ước:
   * - Nếu có lỗi thì return 'error message'
   * - Nếu không có lỗi thì return 'undefined'
   * - Sử dụng biểu thức chính quy để kiểm tra các điều kiện
   */
  var validatorRules = {
    required: function (value) {
      return value ? undefined : "Vui lòng nhập trường này";
    },
    email: function (value) {
      var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      return regex.test(value) ? undefined : "Định dạng email không họp lệ";
    },
    min: function (min) {
      return function (value) {
        return value.length >= min ? undefined : `Vui lòng nhập ${min} ký tự`;
      };
    },
    max: function (max) {
      return function (value) {
        return value.length <= max ? undefined : `Vui lòng nhập ${max} ký tự`;
      };
    },
  };
  // Lấy ra form element  trong DOM theo 'formSelector'
  var formElement = document.querySelector(formSelector);

  // Chỉ xử lý khi có element trong DOM
  if (formElement) {
    var inputs = formElement.querySelectorAll("[name][rules]");
    for (var input of inputs) {
      var rules = input.getAttribute("rules").split("|");
      for (rule of rules) {
        var ruleInfo;
        var isRuleHasValue = rule.includes(":");

        if (isRuleHasValue) {
          ruleInfo = rule.split(":");
          rule = ruleInfo[0];
        }

        var ruleFunc = validatorRules[rule];

        if (isRuleHasValue) {
          ruleFunc = ruleFunc(ruleInfo[1]);
        }

        if (Array.isArray(formRules[input.name])) {
          formRules[input.name].push(ruleFunc);
        } else {
          formRules[input.name] = [ruleFunc];
        }
      }
      //  Lắng nghe sự kiện để validate (blur, change,...).
      input.onblur = handleValidate;
      input.oninput = handleClearError;
    }
    // Hàm thực hiện validate
    function handleValidate(event) {
      var rules = formRules[event.target.name];

      var errorMessage;
      rules.find(function (rule) {
        errorMessage = rule(event.target.value);
        return errorMessage;
      });

      // nếu có lỗi thì hiển thị ra UI
      if (errorMessage) {
        var formGroup = getParent(event.target, ".form-group");
        if (formGroup) {
          formGroup.classList.add("invalid");
          var formMessage = formGroup.querySelector(".form-message");
          if (formMessage) {
            formMessage.innerText = errorMessage;
          }
        }
      }
      return !errorMessage;
    }
    // Hàm xóa lỗi
    function handleClearError(event) {
      var formGroup = getParent(event.target, ".form-group");
      if (formGroup.classList.contains("invalid")) {
        formGroup.classList.remove("invalid");
        var formMessage = formGroup.querySelector(".form-message");
        if (formMessage) {
          formMessage.innerText = "";
        }
      }
    }
  }
  // Xử lý hành vi submit
  formElement.onsubmit = function (event) {
    event.preventDefault();
    var inputs = formElement.querySelectorAll("[name][rules]");
    var isValid = true;
    for (var input of inputs) {
      if (!handleValidate({ target: input })) {
        isValid = false;
      }
    }
    // Khi khoông có lỗi thì submit form
    if (isValid) {
      formElement.submit();
    }
  };
}
