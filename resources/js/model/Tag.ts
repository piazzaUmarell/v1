export default class Tag {

    protected id: number;
    protected name: string;
    protected slug: string;

    public constructor(data: object) {
        this.setId(
            Tag.safeDataAccessor(data, 'id')
        ).setName(
            Tag.safeDataAccessor(data, 'name')
        ).setSlug(
            Tag.safeDataAccessor(data, 'slug')
        );

    }

    protected static safeDataAccessor(data: object, key: string) {
        return data.hasOwnProperty(key) ? data[key] : null;
    }

    public getId(): number {
        return this.id;
    }

    public setId(id: number): Tag {
        this.id = id;
        return this;
    }

    public getName(): string {
        return this.name;
    }

    public setName(name: string): Tag {
        this.name = name;
        return this;
    }

    public getSlug(): string {
        return this.slug;
    }

    public setSlug(slug: string): Tag {
        this.slug = slug;
        return this;
    }

}