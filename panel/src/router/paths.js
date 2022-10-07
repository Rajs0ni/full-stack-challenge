import DEFINES from "@/defines";

// Properties
import PropertyRoot from "../pages/property/Root";
import PropertyList from "../pages/property/List";
import PropertySave from "../pages/property/Save";

export default [
  {
    path: "/",
    redirect:"/property/list",
    name: "Home",
    meta: {
      public: true,
    },
  },
  /* Properties */
  {
    path: "/property",
    name: "property",
    component: PropertyRoot,
    meta: {
      layout: DEFINES.LAYOUT_APP,
    },
    children: [
      {
        path: "list",
        name: "property.list",
        meta: {
          layout: DEFINES.LAYOUT_APP,
        },
        component: PropertyList,
      },
      {
        path: "create",
        name: "property.create",
        meta: {
          layout: DEFINES.LAYOUT_APP,
        },
        component: PropertySave,
      },
      {
        path: "save/:property_id",
        name: "property.save",
        meta: {
          layout: DEFINES.LAYOUT_APP,
        },
        component: PropertySave,
      },
    ],
  },
]