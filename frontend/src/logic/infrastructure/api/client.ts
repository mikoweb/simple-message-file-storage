import { singleton } from 'tsyringe';
import axios from 'axios';

@singleton()
export default class Client {
  private readonly client: any;

  constructor() {
    this.client = axios.create({
      baseURL: import.meta.env.VITE_API_CLIENT_HOST,
    });
  }

  public get method() {
    return this.client;
  }
}
