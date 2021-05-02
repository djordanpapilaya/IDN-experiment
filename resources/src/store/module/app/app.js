const namespace = 'app';

export const SET_DEVICE_STATE = `${namespace}/setDeviceState`;
export const SET_RESOURCES = `${namespace}/setResources`;
export const SET_RESOURCE = `${namespace}/setResource`;
export const SET_TIME = `${namespace}/setTime`;
export const SET_USER_DATA = `${namespace}/setUserData`;
export const SET_GUIDE_WATCHED = `${namespace}/setGuideWatched`;

export default {
  state: {
    deviceState: null,
    resources: null,
    resource: null,
    time: null,
    userData: null,
    guideWatched: null,
  },
  getters: {},
  mutations: {
    [SET_DEVICE_STATE](state, deviceState) {
      state.deviceState = deviceState;
    },
    [SET_RESOURCES](state, resources) {
      state.resources = resources;
    },
    [SET_RESOURCE](state, resource) {
      state.resource = resource;
    },
    [SET_TIME](state, time) {
      state.time = time;
    },
    [SET_USER_DATA](state, userData) {
      state.userData = userData;
    },
    [SET_GUIDE_WATCHED](state, guideWatched) {
      state.guideWatched = guideWatched;
    },
  },
  actions: {},
};
