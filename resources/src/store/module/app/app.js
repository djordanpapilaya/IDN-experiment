const namespace = 'app';

export const SET_DEVICE_STATE = `${namespace}/setDeviceState`;
export const SET_RESOURCES = `${namespace}/setResources`;
export const SET_RESOURCE = `${namespace}/setResource`;
export const SET_TIME = `${namespace}/setTime`;

export default {
  state: {
    deviceState: null,
    resources: null,
    resource: null,
    time: null,
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
  },
  actions: {},
};
