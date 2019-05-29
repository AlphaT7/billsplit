let page = page => {
  let pages = [
    "section_main",
    "section_customers",
    "section_customergroups",
    "section_restaurants",
    "section_orders",
    "section_about"
  ];
  for (let i = 0; i < pages.length; i++) {
    document.getElementById(pages[i]).classList.add("hidden");
  }
  document.getElementById(page).classList.remove("hidden");
};

document.addEventListener("touchstart", function() {}, false); // needed for ios on-focus css //

/* -- TABULATOR JS FUNCTIONS -- */

//Build Tabulator
var customerresults = new Tabulator("#customer_results", {
  rowClick: function(e, row) {
    getCustomer(row.getCell("id").getValue());
    document.querySelector("#section_add_customers").classList.toggle("hidden");
  },
  layout: "fitColumns",
  placeholder: "No Data Set",
  columns: [
    {
      title: "ID",
      field: "id",
      sorter: "string",
      visible: false
    },
    { title: "First", field: "f_name", sorter: "string" },
    { title: "Last", field: "l_name", sorter: "string" },
    { title: "Nickname", field: "nickname", sorter: "string" }
  ]
});

/* -- BUTTON EVENTS -- */

// Get the parent DIV, add click listener...
document.addEventListener("click", function(e) {
  // e.target was the clicked element
  if (e.target && e.target.matches("#update_customer")) {
    updateCustomer(e.target.dataset.id);
  }

  if (e.target && e.target.matches(".btn_main_screen")) {
    hideSection();
    page("section_main");
  }

  if (e.target && e.target.matches(".btn_customers")) {
    page("section_customers");
    getCustomers();
  }

  if (e.target && e.target.matches(".btn_customergroups")) {
    page("section_customergroups");
    getCustomerGroups();
  }

  if (e.target && e.target.matches(".btn_restaurants")) {
    page("section_restaurants");
    getRestaurants();
  }

  if (e.target && e.target.matches(".btn_orders")) {
    page("section_orders");
  }

  if (e.target && e.target.matches(".btn_about")) {
    page("section_about");
  }

  if (e.target && e.target.matches("#add_customer")) {
    document.querySelector("#section_add_customer").classList.toggle("hidden");
  }

  if (e.target && e.target.matches("#submit_new_customer")) {
    addCustomer();
  }

  if (e.target && e.target.matches("#btn_delete_customer")) {
    let r = confirm(
      "Are you sure you wish to delete customer: " + e.target.dataset.name + "?"
    );
    if (r) {
      deleteCustomer(e.target.dataset.id);
    }
  }

  if (e.target && e.target.matches("#btn_return_to_customers")) {
    document
      .querySelector("#section_edit_customers")
      .classList.toggle("hidden");
    document.querySelector("#section_main").classList.toggle("hidden");
  }
});

/* -- OTHER FUNCTIONS -- */

let toggleSection = (html_section, css_class) => {
  document.querySelector(html_section).classList.toggle(css_class);
};

/* -- XHR GET FUNCTIONS -- */

let getCustomers = () => {
  let xmlhttp;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState < 4) {
      document.querySelector("#customers_loading_status").style.visibility =
        "visible";
    }
    if (xmlhttp.readyState == 4) {
      document.querySelector("#customers_loading_status").style.visibility =
        "hidden";
      let data = xmlhttp.responseText;

      //document.querySelector("#customer_results").innerHTML = data;
      customerresults.setData(data);
    }
  };
  let timestamp = Date.now();
  let link = "./php/getcustomers.php?timestamp=" + timestamp;
  xmlhttp.open("GET", link, true);
  xmlhttp.send(null);
};

let getCustomer = id => {
  let xmlhttp;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState < 4) {
      document.querySelector("#customers_loading_status").style.visibility =
        "visible";
    }
    if (xmlhttp.readyState == 4) {
      document.querySelector("#customers_loading_status").style.visibility =
        "hidden";
      let data = xmlhttp.responseText;

      document.querySelector("#section_edit_customers").innerHTML = data;
    }
  };
  let timestamp = Date.now();
  let link = "./php/getcustomer.php?id=" + id + "&timestamp=" + timestamp;
  xmlhttp.open("GET", link, true);
  xmlhttp.send(null);
};

let getRestaurants = () => {
  let xmlhttp;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState < 4) {
      document.querySelector("#restaurants_loading_status").style.visibility =
        "visible";
    }
    if (xmlhttp.readyState == 4) {
      document.querySelector("#restaurants_loading_status").style.visibility =
        "hidden";
      let data = xmlhttp.responseText;

      document.querySelector("#restaurants_results").innerHTML = data;
    }
  };
  let timestamp = Date.now();
  let link = "./php/getrestaurants.php?timestamp=" + timestamp;
  xmlhttp.open("GET", link, true);
  xmlhttp.send(null);
};

let getCustomerGroups = () => {
  let xmlhttp;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState < 4) {
      document.querySelector(
        "#customergroups_loading_status"
      ).style.visibility = "visible";
    }
    if (xmlhttp.readyState == 4) {
      document.querySelector(
        "#customergroups_loading_status"
      ).style.visibility = "hidden";
      let data = xmlhttp.responseText;

      document.querySelector("#customergroups_results").innerHTML = data;
    }
  };
  let timestamp = Date.now();
  let link = "./php/getcustomergroups.php?timestamp=" + timestamp;
  xmlhttp.open("GET", link, true);
  xmlhttp.send(null);
};

/* -- XHR UPDATE FUNCTIONS -- */

let updateCustomer = id => {
  let xmlhttp;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState < 4) {
      document.querySelector("#customer_update_status").style.visibility =
        "visible";
    }
    if (xmlhttp.readyState == 4) {
      document.querySelector("#customer_update_status").style.visibility =
        "hidden";
      let data = xmlhttp.responseText;
      alert(data);
    }
  };
  let url =
    "?id=" +
    id +
    "&f_name=" +
    document.querySelector("#f_name").value +
    "&l_name=" +
    document.querySelector("#l_name").value +
    "&nickname=" +
    document.querySelector("#nickname").value +
    "&email=" +
    document.querySelector("#email").value;

  let timestamp = Date.now();
  let link = "./php/updatecustomer.php" + url + "&timestamp=" + timestamp;
  xmlhttp.open("GET", link, true);
  xmlhttp.send(null);
};

/* -- XHR INSERT FUNCTIONS -- */

let addCustomer = () => {
  let xmlhttp;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState < 4) {
      document.querySelector("#customer_add_status").style.visibility =
        "visible";
    }
    if (xmlhttp.readyState == 4) {
      document.querySelector("#customer_add_status").style.visibility =
        "hidden";
      let data = xmlhttp.responseText;
      getCustomers();
      alert(data);
    }
  };
  let url =
    "?f_name=" +
    document.querySelector("#add_f_name").value +
    "&l_name=" +
    document.querySelector("#add_l_name").value +
    "&nickname=" +
    document.querySelector("#add_nickname").value +
    "&email=" +
    document.querySelector("#add_email").value;

  let timestamp = Date.now();
  let link = "./php/addcustomer.php" + url + "&timestamp=" + timestamp;
  xmlhttp.open("GET", link, true);
  xmlhttp.send(null);
};

/* -- XHR DELETE FUNCTIONS -- */

let deleteCustomer = id => {
  let xmlhttp;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState < 4) {
      document.querySelector("#customers_loading_status").style.visibility =
        "visible";
    }
    if (xmlhttp.readyState == 4) {
      document.querySelector("#customers_loading_status").style.visibility =
        "hidden";
      getCustomers();
      let data = xmlhttp.responseText;
      alert(data);
    }
  };

  let timestamp = Date.now();
  let link = "./php/deletecustomer.php?id=" + id + "&timestamp=" + timestamp;
  xmlhttp.open("GET", link, true);
  xmlhttp.send(null);
};