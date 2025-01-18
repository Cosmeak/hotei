import "./bootstrap";
import "../css/app.css";

import { createApp, h, DefineComponent, App } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

/**
 * Register all global UI components in the entire without having to import it on all pages
 */
// const registerGlobalComponents = (app: App) => {
//   const components = import.meta.glob("./Components/ui/**/*.vue");
//   Object.entries(components).forEach(([path, componentConfig]) => {
//     const componentName: string | undefined = path
//       .split("/")
//       .pop()
//       ?.replace(/\.\w+$/, "") as string;

//     app.component(componentName, componentConfig.default);
//   });
// };

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
    const app = createApp({ render: () => h(App, props) })
      .use(plugin)
      .mixin(methods)
      .use(ZiggyVue);

    // registerGlobalComponents(app);

    app.mount(el);
  },
  progress: {
    color: "#4B5563",
  },
});

const methods =  {
  methods: {
    route,
    isAdmin(): Boolean {
      return this.$page.props.auth.user.role == 'admin';
    }
  }
}
