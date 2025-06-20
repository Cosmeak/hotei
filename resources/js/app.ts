import "./bootstrap";
import "../css/app.css";

import { createSSRApp, h, DefineComponent } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { Link, Head } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import BackOfficeLayout from "@/Layouts/BackOfficeLayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

/**
 * Create inertia app and mount vue inside
 */
createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: async (name) => {
    const page = await resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob<DefineComponent>([
        "./Pages/**/*.vue",
        "./Layouts/**/*.vue",
      ]),
    );

    switch (true) {
      case name.startsWith("BackOffice/"):
        page.default.layout = BackOfficeLayout;
        break;
      case name.startsWith("Auth/"):
        page.default.layout = AuthLayout;
        break;
      default:
        page.default.layout = AppLayout;
        break;
    }

    return page;
  },
  setup({ el, App, props, plugin }) {
    createSSRApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .component("InertiaLink", Link)
      .component("InertiaHead", Head)
      .mixin({
        methods: {
          route,
          isAdmin(): boolean {
            return this.$page.props.auth.user.role == "admin";
          },
        },
      }).mount(el);
  },
  progress: {
    color: "#4B5563",
  },
});
