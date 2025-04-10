import { DefineComponent, App } from "vue";

/**
 * Register all global UI components in the entire without having to import it on all pages
 */
const registerGlobalComponents = (app: App) => {
  const modules = import.meta.glob("./Components/ui/**/*/index.ts", {
    eager: true,
  }) as Record<
    string,
    Record<string, DefineComponent<unknown, unknown, unknown>>
  >;
  Object.values(modules).forEach((module) => {
    Object.entries(module).forEach(([name, component]) => {
      console.log(`Registering component: ${name}`, component);
      if (!component) {
        console.error(`Component ${name} is null or undefined!`);
      }
      app.component(`V${name}`, component);
    });
  });
};

export default registerGlobalComponents;
