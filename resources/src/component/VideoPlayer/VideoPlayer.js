import { AbstractTransitionComponent } from 'vue-transition-component';
import VueTypes from 'vue-types';
import VideoPlayerTransitionController from './VideoPlayerTransitionController';
import { getValue } from '../../util/injector';
import { GATEWAY } from '../../data/Injectables';
import { mapState } from 'vuex';

// @vue/component
export default {
  name: 'VideoPlayer',
  extends: AbstractTransitionComponent,
  props: {
    data: VueTypes.any.isRequired,
  },
  computed: {
    ...mapState({
      resource: (state) => state.app.resource,
    }),
  },
  data(){
    return {
      playTime: 0,
      pauseTime: 0,
    };
  },
  methods: {
    handleAllComponentsReady() {
      this.transitionController = new VideoPlayerTransitionController(this);
      this.isReady();
    },
    play(e) {
      const time = e.target.currentTime;
      console.log('PLAY', time);
      this.playTime = time;
    },
    pause(e) {
      const time = e.target.currentTime;
      const gateway = getValue(GATEWAY);
      const id = this.resource.id;

      this.pauseTime = time;

      gateway.post('event/video', {
        'resource_id': id,
        'start_time': this.playTime,
        'end_time': this.pauseTime,
        'sequence_time': this.pauseTime - this.playTime,
      }).then(() => {
        console.log('TRACK_VIDEO PLAY', this.playTime);
        console.log('TRACK_VIDEO PAUSE', this.pauseTime);
        console.log('TRACK_VIDEO TOTAL_TIME', this.pauseTime - this.playTime);
      });
    }
  },
};
