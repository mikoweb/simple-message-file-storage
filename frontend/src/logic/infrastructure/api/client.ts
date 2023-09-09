import { singleton } from 'tsyringe';
import axios from 'axios';

@singleton()
export default class Client {
  private readonly client: axios;

  constructor() {
    this.client = axios.create({
      baseURL: import.meta.env.VITE_API_CLIENT_HOST,
    });
  }

  public get method(): axios {
    return this.client;
  }
}
