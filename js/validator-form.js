/** HƯỚNG DẪN SỬ DỤNG
 * Validator({
    form: '#frm-register', // id form
    formGroupSelector: '.form-group', // class cha
    errorSelector: ".form-message", // class báo lỗi
    rules: [
        Validator.isRequired('#username'),
        Validator.minLength('#password', 6),
        Validator.isRequired('#password-confirmation'),
        Validator.isConfirmed('#password-confirmation', function (){
          return document.querySelector('#frm-register #password').value;
        }, 'Mật khẩu không trùng khớp'),
        Validator.isRequired('#email'),
        Validator.isEmail('#email'),
        Validator.isRequired('#pro'),
        Validator.isRequired('#file'),
        Validator.isRequired('input[name="gender"]'),
    ],
    //khi sử dụng submit js
    onSubmit: function (data){
        // Call API
        console.log(data);
    }
});
*/
/**
 * Quy ước class:
 * - Class cha chứa thẻ input: form-group
 * - input: .form- control
 * - Class thẻ hiện lỗi : form-message --> <span class="form-message"></span>
 */

function Validator(options) {
  function getParent(element, selector) {
    while (element.parentElement) {
      if (element.parentElement.matches(selector)) {
        return element.parentElement;
      }
      element = element.parentElement;
    }
  }
  var selectorRules = {};

  // Hàm thực hiện validate
  function validate(inputElement, rule) {
    var errorElement = getParent(
      inputElement,
      options.formGroupSelector
    ).querySelector(options.errorSelector);
    var errorMessage;

    // lấy ra các rules của selector
    var rules = selectorRules[rule.selector];

    // Lặp qua các rule và kiểm kiểm tra
    // Nếu có lỗi thì dừng ktra
    for (var i = 0; i < rules.length; i++) {
      // Trường hợp dùng checkbox và radio
      switch (inputElement.type) {
        case "radio":
        case "checkbox":
          errorMessage = rules[i](
            formElement.querySelector(rule.selector + ":checked")
          );
          break;
        default:
          errorMessage = rules[i](inputElement.value);
      }

      if (errorMessage) break;
    }

    // Kiểm tra lỗi
    if (errorMessage) {
      errorElement.innerText = errorMessage;
      getParent(inputElement, options.formGroupSelector).classList.add(
        "invalid"
      );
    } else {
      errorElement.innerText = "";
      getParent(inputElement, options.formGroupSelector).classList.remove(
        "invalid"
      );
    }
    return !errorMessage;
  }
  //   Lấy element của form cần validate
  var formElement = document.querySelector(options.form);

  if (formElement) {
    // Khi submit form
    formElement.onsubmit = function (e) {
      // Tắt hành vi submit mặc định của form
      e.preventDefault();
      var isFormValid = true;
      // Lặp qua từng rules và validate
      options.rules.forEach(function (rule) {
        var inputElement = formElement.querySelector(rule.selector);
        var isValid = validate(inputElement, rule);
        if (!isValid) {
          isFormValid = false;
        }
      });

      if (isFormValid) {
        // Trường hợp submit với javascript
        if (typeof options.onSubmit === "function") {
          var enableInputs = formElement.querySelectorAll(
            "[name]:not([disabled])"
          );

          var formValues = Array.from(enableInputs).reduce(function (
            values,
            input
          ) {
            switch (input.type) {
              case "radio":
                values[input.name] = formElement.querySelector(
                  'input[name="' + input.name + '"]:checked'
                ).value;
                break;
              case "checkbox":
                if (!input.matches(":checked")) {
                  values[input.name] = "";
                  return values;
                }
                if (!Array.isArray(values[input.name])) {
                  values[input.name] = [];
                }
                values[input.name].push(input.value);
                break;
              case "file":
                values[input.name] = input.files;
                break;
              default:
                values[input.name] = input.value;
            }
            return values;
          },
          {});
          options.onSubmit(formValues);
        }
        // Trường hợp với hành vi mặc định của trình duyêt
        else {
          formElement.submit();
        }
      }
    };
    // Xử lý lặp qua mỗi rules
    // Xử lý các sư kiện (blur, input)
    options.rules.forEach(function (rule) {
      // Lưu lại các rules cho mỗi input
      if (Array.isArray(selectorRules[rule.selector])) {
        selectorRules[rule.selector].push(rule.test);
      } else {
        selectorRules[rule.selector] = [rule.test];
      }

      var inputElements = formElement.querySelectorAll(rule.selector);
      Array.from(inputElements).forEach(function (inputElement) {
        // Xử lý trường hợp khi người dùng blur ra khỏi thẻ input
        inputElement.onblur = function () {
          validate(inputElement, rule);
        };
        // Xử lý trường hợp khi người dùng nhập (xóa lỗi)
        inputElement.oninput = function () {
          var errorElement = getParent(
            inputElement,
            options.formGroupSelector
          ).querySelector(options.errorSelector);
          errorElement.innerText = "";
          getParent(inputElement, options.formGroupSelector).classList.remove(
            "invalid"
          );
        };
      });
    });
  }
}
// Định nghĩa các rules
/** Nguyên tắc của các Rule
 * 1. Khi có lỗi => trả về message lỗi
 * 2. khi hợp lệ => Trả về undefined
 */
// Bắt buộc nhập
Validator.isRequired = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      return value ? undefined : message || "Vui lòng nhập trường này";
    },
  };
};
// Kiểm tra chỉ chấp nhận số và chữ cái
Validator.isUserName = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^(?=.*?[0-9])(?=.*?[a-zA-Z])/;
      return regex.test(value)
        ? undefined
        : message || "Trường này chỉ chấp nhận số và chữ cái";
    },
  };
};
// Kiểm tra email
Validator.isEmail = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      return regex.test(value)
        ? undefined
        : message || "Trường này phải là email";
    },
  };
};
//Kiểm tra phone bắt đầu bằng số 0 và có 10 số
Validator.isPhone = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^(?:0[0-9]{9})$/;
      return regex.test(value)
        ? undefined
        : message || "Trường này phải là số điện thoại";
    },
  };
};
// Kiểm tra mật khẩu từ min đến max ký tự chứa ít nhất một chữ thường, một chữ in hoa, một chữ số và một ký tự đặc biệt
Validator.isPassword = function (selector, min, max, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/;
      if (regex.test(value) && value.length >= min && value.length <= max) {
        return undefined;
      } else {
        return (
          message ||
          `Mật khẩu từ ${min} - ${max} ký tự, có ít nhất 1 chữ thường, 1 chữ in hoa, một chữ số và một ký tự đặc biệt`
        );
      }
    },
  };
};
// Kiểm tra độ dài từ min-max
Validator.minMaxLength = function (selector, min, max, message) {
  return {
    selector: selector,
    test: function (value) {
      if (value.length >= min && value.length <= max) {
        return undefined;
      } else {
        return (
          message || `Trường này yêu cầu ít nhất ${min} và tối đa ${max} ký tự`
        );
      }
    },
  };
};
// Nhập độ dài tối thiếu
Validator.minLength = function (selector, min, message) {
  return {
    selector: selector,
    test: function (value) {
      return value.length >= min
        ? undefined
        : message || `Vui lòng nhập tối thiểu ${min} ký tự`;
    },
  };
};
// Kiểm tra độ dài tối đa
Validator.maxLength = function (selector, max, message) {
  return {
    selector: selector,
    test: function (value) {
      return value.length <= max
        ? undefined
        : message || `Vui lòng nhập tối đa ${max} ký tự`;
    },
  };
};
//Kiểm tra số tối thiểu
Validator.numberMin = function (selector, min, message) {
  return {
    selector: selector,
    test: function (value) {
      return parseInt(value) > min
        ? undefined
        : message || `Trường này phải >= ${min}`;
    },
  };
};
// Kiểm tra sự trùng khớp dữ liệu
Validator.isConfirmed = function (selector, getConfirmValue, message) {
  return {
    selector: selector,
    test: function (value) {
      return value === getConfirmValue()
        ? undefined
        : message || "Giá trị nhập vào không chính xác";
    },
  };
};
