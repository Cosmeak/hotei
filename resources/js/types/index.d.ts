import { Config } from "ziggy-js";

export type PageProps<
  T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
  auth: {
    user: User;
  };
  ziggy: Config & { location: string };
};

export interface User {
  id: string;
  avatar: string;
  firstname: string;
  lastname: string;
  email: string;
  email_verified_at?: string;
  credits: number;
  subscription_credits: string;
  created_at: string;
  updated_at: string;
  role: 'user'|'admin'|'craftman';
}

export interface Craftman {
  id: string;
  avatar: string;
  description: string;
  created_at: string;
  updated_at: string;
  user: User;
  categories: Craftsmanship[];
}

export interface Craftsmanship {
  id: string;
  name: string;
  color: string;
  description: string;
  created_at: string;
  updated_at: string;
}

export interface Material {
  name: string;
  quantity: number;
}

export interface Course {
  id: string;
  title: string;
  description: string;
  duration: number;
  materials?: Material[];
  created_at: string;
  updated_at: string;
  project?: Project;
  is_draft: boolean;
  is_skill?: boolean;
  craftman?: Craftman;
  category?: string;
  cost?: number;
  difficulty?: number;
}

export interface Project {
  id: string;
  title: string;
  description: string;
  duration: number;
  created_at: string;
  updated_at: string;
  courses?: Course[];
  craftman: Craftman;
  materials?: Material[];
}
