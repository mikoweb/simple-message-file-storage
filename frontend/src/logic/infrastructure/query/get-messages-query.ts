import { singleton, inject } from "tsyringe";
import Client from "@/logic/infrastructure/api/client";

@singleton()
export default class GetMessagesQuery {
  constructor(
    @inject(Client) private readonly client: Client
  ) {}

  public async getEmployees(): Promise<Array<any>> {
    const resposne = await this.client.method.get('message/');

    return resposne.data;
  }
}
