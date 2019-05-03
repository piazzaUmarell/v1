import Homepage from "./pages/Homepage";
import Constants from "./Constants";
import EpisodeDetail from "./pages/EpisodeDetail";
import AdminLoginPage from "./pages/Admin/LoginPage";
import AdminHomepage from "./pages/Admin/Homepage";

export default [
    { path:"/", name: Constants.ROUTE_HOMEPAGE, component: Homepage },
    { path: "/episodio/:slug", name: Constants.ROUTE_EPISODE_SHOW, component: EpisodeDetail },
    { path: "/admin/login", name: Constants.ROUTE_ADMIN_LOGIN, component: AdminLoginPage },
    { path: "/admin", name: Constants.ROUTE_ADMIN_HOME, component: AdminHomepage}
];