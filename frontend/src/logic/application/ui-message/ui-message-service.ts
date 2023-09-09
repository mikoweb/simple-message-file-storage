import { toastController, ToastOptions } from '@ionic/vue';
import { singleton } from 'tsyringe';

@singleton()
export default class UiMessageService {
  private readonly defaultOptions: ToastOptions = {
    duration: 2000,
    position: 'bottom',
    buttons: [{
      text: '✖',
      role: 'cancel',
    }]
  };

  public async createMessage(options: ToastOptions) {
    const toast = await toastController.create(this.mergeWithDefault(options));

    return await toast.present();
  }

  public async createSuccess(options: ToastOptions) {
    return await this.createMessage(this.mergeOptions(options, {color: 'success'}));
  }

  public async createError(options: ToastOptions) {
    return await this.createMessage(this.mergeOptions(options, {color: 'danger'}));
  }

  private mergeWithDefault(options: ToastOptions): ToastOptions {
    return this.mergeOptions(this.defaultOptions, options);
  }

  private mergeOptions(a: ToastOptions, b: ToastOptions): ToastOptions {
    return {...a, ...b};
  }
}
