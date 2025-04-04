import "./bootstrap";
import "../css/app.css";

import { createSSRApp, h, DefineComponent, App, Component } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { Link, Head } from "@inertiajs/vue3";
import registerGlobalComponents from "./utils/meta";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

/**
 * Create inertia app and mount vue inside
 */
createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob<DefineComponent>("./Pages/**/*.vue"),
    ),
  setup({ el, App, props, plugin }) {
    const app = createSSRApp({ render: () => h(App, props) })
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
      });

    registerGlobalComponents(app);

    app.mount(el);
  },
  progress: {
    color: "#4B5563",
  },
});
