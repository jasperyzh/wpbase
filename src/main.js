// bootstrap version: 4.6.1
// import bootstrap from "bootstrap";

import * as bootstrap from "bootstrap";

import "./assets/bg-aside.jpg";
import "./assets/bg-yayasan_dots1.png";
import "./assets/bg-yayasan_dots2.png";

import "./sass/style.scss";

// _s-js
// import "./js/navigation.js";
// import "./js/customizer.js";

/* 
import { createApp } from "vue";
import App from "./App.vue";

createApp(App).mount("#app");
 */

document.addEventListener("DOMContentLoaded", () => {
  // widget:popup-modal
  const popup_element = document.getElementById("popup-modal");
  if (popup_element) {
    const popup_modal = new bootstrap.Modal(popup_element);
    popup_modal.show();
  }

  // widget:toast-notification
  const toastElList = document.querySelectorAll(".toast");
  if (toastElList) {
    // const toastList = [...toastElList].map((toastEl) => {
    [...toastElList].map((toastEl) => {
      toastEl = new bootstrap.Toast(toastEl);
      toastEl.show();
    });
  }
});
