import Homepage from "./pages/Homepage";
import Constants from "./Constants";
import EpisodeDetail from "./pages/EpisodeDetail";

export default [
    { path:"/", name: Constants.ROUTE_HOMEPAGE, component: Homepage },
    { path: "/episodio/:slug", name: Constants.ROUTE_EPISODE_SHOW, component: EpisodeDetail }
];