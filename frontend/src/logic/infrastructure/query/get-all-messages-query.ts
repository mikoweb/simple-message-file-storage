import { singleton, inject } from 'tsyringe';
import Client from "@/logic/infrastructure/api/client";
import MessageDto from "@/logic/domain/dto/message-dto";

@singleton()
export default class GetAllMessagesQuery {
  constructor(
    @inject(Client) private readonly client: Client
  ) {}

  public async getAll(): Promise<MessageDto[]> {
    const resposne = await this.client.method.get('message/');
    const rawArray: any[] = resposne.data;

    return rawArray.map((object: any) => MessageDto.fromRawObject(object));
  }
}
