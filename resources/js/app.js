import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';


const app = createApp(App);
app.mount('#app');

window.scrollToSection = function(section) {
  if (app && app._instance && app._instance.proxy && app._instance.proxy.scrollToSection) {
    app._instance.proxy.scrollToSection(section);
  }
};

// Make the Vue app instance globally accessible for the chatbot
window.vueApp = app;
