import { AbstractTransitionComponent } from 'vue-transition-component';
import moment from 'moment';
import { mapMutations, mapState } from 'vuex';
import TimerTransitionController from './TimerTransitionController';
import { SET_TIME } from '../../store/module/app/app';
import { getValue } from '../../util/injector';
import { GATEWAY } from '../../data/Injectables';

// @vue/component
export default {
  name: 'Timer',
  extends: AbstractTransitionComponent,
  data() {
    return {
      elapsedTime: 0,
      remaining: 0,
      experimentTime: 0,
      hours: 0,
      minutes: 0,
      seconds: 0,
      timerReady: false,
      timer: null,
    };
  },
  computed: {
    ...mapState({
      time: state => state.app.time,
    }),
  },
  methods: {
    ...mapMutations({
      setTime: SET_TIME,
    }),
    handleAllComponentsReady() {
      this.transitionController = new TimerTransitionController(this);
      this.isReady();
      setTimeout(() => {
        this.setExperimentTime();
        this.startTimer();
        this.timerReady = true;
      }, 1000);
    },
    startTimer() {
      let timeElement, eventTime, currentTime, duration, interval, intervalId;
      interval = 1000; // 1 second
      currentTime = moment();
      eventTime = moment().add(this.time.experiment_time, 'minutes').subtract(this.time.total_time, 'minutes');

      duration = moment.duration(eventTime.diff(currentTime));

      this.timer = setInterval(() => {
        // get updated duration
        duration = moment.duration(duration - interval, 'milliseconds');
        this.duration = moment.duration(duration - interval, 'milliseconds');

        // if duration is >= 0
        if (duration.asSeconds() <= 0) {
          clearInterval(intervalId);
          // hide the countdown element
          this.hours = 0;
          this.minutes = 0;
          this.seconds = 0;
        } else {
          // otherwise, show the updated countdown
          this.hours = duration.hours();
          this.minutes = duration.minutes();
          this.seconds = duration.seconds();
        }
      }, interval);

    },
    setExperimentTime() {
      const currentTime = moment();
      const startTime = moment().add(this.time.experiment_time, 'minutes');

      this.experimentTime = moment.duration(startTime.diff(currentTime));
    },
    pauseTimer() {
      clearInterval(this.timer);
    },
    playTimer() {
      this.setExperimentTime();
      this.startTimer();
      this.timerReady = true;
    }
  },
};
