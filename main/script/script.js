"use strict";
// GET USERS (ADMIN/INSTRUCTOR/STUDENT)
const get_users = function (val) {
  if (val === 1) {
    // FOR (FC_VENDOR/FC_OPERATOR)
    const user = get_id("select");
    const username = get_id("username");
    const password = get_id("password");

    // CHECK (ADMIN/INSTRUCTOR/STUDENT) EMPTY ?
    check_empty(user, username, password);
  }

  //   if (val === 2) {
  //     // FOR (FC_CUST)
  //     const user = "customer";
  //     alert(user);
  //     const tableNumber = get_id("selectTable");

  //     let customer = new CUSTOMER(
  //       user,
  //       "role=" + user + "&tableNumber=" + tableNumber
  //     );
  //     customer.customer_load_data();
  //   }
};
// GET ID VAL
const get_id = (id_val) => {
  return document.getElementById(id_val).value;
};

//CHECK (ADMIN/INSTRUCTOR/STUDENT) EMPTY INPUT Y/N ?
const check_empty = function (user, username, password) {
  if (user.length === 0 || username.length === 0 || password.length === 0) {
    alert("input cannot be empty");
  } else if (user.length != 0 || username.length != 0 || password.length != 0) {
    assign_class(user, username, password);
  }
};

//  ASSIGN (USER) (FC_VENDOR/FC_OPERATOR/FC_CUST)
const assign_class = function (user, username, password) {
  if (user === "admin") {
    let admin = new ADMIN(
      "role=" + user + "&username=" + username + "&password=" + password
    );
    admin.admin_load_data();
  }
  if (user === "instructor") {
    alert("this phase is under construction");
  }
};

// (USERS) MAIN CLASS
class USERS {
  constructor(data) {
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open("POST", "main/includes/includes.user_login.php", true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );

    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        const output = this.responseText;
        try {
          console.log(output);
          if (output === "1") trueHandler();
          else errHandler();
        } catch (err) {
          console.log(err.message);
        }
      }
    };
    request.send(data);
  }
}

//  (USERS)-->(ADMIN) CLASS
class ADMIN extends USERS {
  constructor(data) {
    super(data);
  }

  // ADMIN LOAD DATA
  admin_load_data() {
    this.loadAjax(this.data, this.admin_true_handler, this.admin_err_handler);
  }

  // (ADMIN) TRUE HANDLER FUNC
  admin_true_handler() {
    location.replace("club_admin");
  }

  // (ADMIN) ERROR HANDLER FUNC
  admin_err_handler() {
    alert("Wrong password");
  }
}
