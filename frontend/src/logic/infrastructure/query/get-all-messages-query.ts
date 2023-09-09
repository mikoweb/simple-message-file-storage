import { inject, singleton } from 'tsyringe';
import Client from "@/logic/infrastructure/api/client";
import MessageDto from "@/logic/domain/dto/message-dto";
import MessageSortDto from "@/logic/domain/dto/message-sort-dto";

@singleton()
export default class GetAllMessagesQuery {
  constructor(
    @inject(Client) private readonly client: Client
  ) {}

  public async getAll(sort?: MessageSortDto | null): Promise<MessageDto[]> {
    const queryString = sort ? ('?' + new URLSearchParams({
        'sort[sortOption]': sort.sortOption,
        'sort[sortDirection]': sort.sortDirection
      }).toString()) : ''

    const resposne = await this.client.method.get(`message/${queryString}`);
    const rawArray: any[] = resposne.data;

    return rawArray.map((object: any) => MessageDto.fromRawObject(object));
  }
}
