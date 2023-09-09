import { singleton } from "tsyringe";
import axios from 'axios';

@singleton()
export default class Client {
  private readonly client: axios;

  constructor() {
    // TODO api host from env
    this.client = axios.create({
      baseURL: 'http://simple-message-file-storage.dev/api/',
    });
  }

  public get method(): axios {
    return this.client;
  }
}
