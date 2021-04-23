import { DeviceStateEvent } from 'seng-device-state-tracker';
import { mapMutations, mapState } from 'vuex';
import { FlowManager, AbstractRegistrableComponent } from 'vue-transition-component';
import { SET_DEVICE_STATE, SET_RESOURCES } from '../store/module/app/app';
import { RouteNames } from '../router/routes';
import MainHeader from '../component/MainHeader';
import MainFooter from '../component/MainFooter';
import { GATEWAY } from '../data/Injectables';
import { getValue } from '../util/injector';

// @vue/component
export default {
  name: 'App',
  computed: {
    ...mapState({
      deviceState: (state) => state.app.deviceState,
    }),
  },
  data() {
    return {
      resourcesLoaded: false,
    };
  },
  components: {
    MainHeader,
    MainFooter,
  },
  created() {
    this.$deviceStateTracker.addEventListener(
      DeviceStateEvent.STATE_UPDATE,
      this.handleDeviceStateUpdate,
    );
    this.setDeviceState(this.$deviceStateTracker.currentState);

    this.initResources();
  },
  methods: {
    ...mapMutations({
      setDeviceState: SET_DEVICE_STATE,
      setResources: SET_RESOURCES,
    }),
    handleDeviceStateUpdate(event) {
      this.setDeviceState(event.data.state);
    },
    onLeave(element, done) {
      FlowManager.transitionOut.then(() => FlowManager.done()).then(done);
    },
    initResources() {
      const gateway = getValue(GATEWAY);

      gateway.get('resources').then((result) => {
        this.setResources(result.data);
      }).then(() => {
        this.resourcesLoaded = true;
      });
    },
  },
};
