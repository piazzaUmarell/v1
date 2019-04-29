import Constants from "../Constants";
import Tag from "./Tag";

export default class Episode {

    protected id: number;
    protected title: string;
    protected slug: string;
    protected number: string;
    protected abstract: string;
    protected description: string;
    protected publication_date: Date;
    protected duration: string;
    protected source: string;
    protected tags: Tag[] = [];

    public constructor(data: object) {
        this.setId(
            Episode.safeDataAccessor(data, 'id')
        ).setTitle(
            Episode.safeDataAccessor(data, 'title')
        ).setSlug(
            Episode.safeDataAccessor(data, 'slug')
        ).setNumber(
            Episode.safeDataAccessor(data, 'number')
        ).setAbstract(
            Episode.safeDataAccessor(data, 'abstract')
        ).setDescription(
            Episode.safeDataAccessor(data, 'description')
        ).setSource(
            Episode.safeDataAccessor(data, 'source')
        ).setDuration(
            Episode.safeDataAccessor(data, 'duration')
        ).setPublicationDate(
            new Date(Episode.safeDataAccessor(data, 'publication_date'))
        );

        let categories : [] = Episode.safeDataAccessor(data, 'categories');

        for(let category of categories) {
            this.tags.push(new Tag(category));
        }
    }

    protected static safeDataAccessor(data: object, key: string) {
        return data.hasOwnProperty(key) ? data[key] : null;
    }

    public getId(): number {
        return this.id;
    }

    public setId(id: number): Episode {
        this.id = id;
        return this;
    }

    public getTitle(): string {
        return this.title;
    }

    public setTitle(title: string): Episode {
        this.title = title;
        return this;
    }

    public getAbstract(): string {
        return this.abstract;
    }

    public setAbstract(abstract: string): Episode {
        this.abstract = abstract;
        return this;
    }

    public getDescription(): string {
        return this.description;
    }

    public setDescription(description: string): Episode {
        this.description = description;
        return this;
    }

    public getSource(): string {
        return this.source;
    }

    public setSource(source: string): Episode {
        this.source = source;
        return this;
    }

    public getNumber(): string {
        return this.number;
    }

    public getPublicationDate(): Date {
        return this.publication_date;
    }

    public setNumber(number: string): Episode {
        this.number = number;
        return this;
    }

    public getDuration(): string {
        return this.duration;
    }

    public setDuration(duration: string): Episode {
        this.duration = duration;
        return this;
    }

    public getSlug(): string {
        return this.slug;
    }

    public setSlug(slug: string): Episode {
        this.slug = slug;
        return this;
    }

    public setPublicationDate(publicationDate: Date): Episode {
        this.publication_date = publicationDate;
        return this;
    }

    public isPublishedAfter(other: Episode): boolean {
        return other.getPublicationDate() < this.getPublicationDate();
    }

    public getDetailRoute() {
        return {
            name: Constants.ROUTE_EPISODE_SHOW,
            params: {
                'slug' : this.slug
            }
        }
    }

    public getPublicationDateForHumans() {
        return this.publication_date.toLocaleString()
    }

    public getCategories() : Tag[] {
        return this.tags;
    }

    public setCategories(categories: Tag[]): Episode {
        this.tags = categories;
        return this;
    }

}