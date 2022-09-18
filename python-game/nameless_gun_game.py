import pygame
import numpy as np
import math
import random

pygame.init()

#main window
screen_width = 1280
screen_height = 720
screen = pygame.display.set_mode((screen_width, screen_height))
pygame.display.set_caption('Nameless Gun v1.2')

#frames per second
clock = pygame.time.Clock()

#colors
WHITE = [255, 255, 255]
YELLOW = [255, 204, 0]
BLUE = [69, 129, 208]
RED = [179, 0, 0]
GREY = [77, 77, 77]
BLACK = [0, 0, 0]

#images
menu_img = pygame.image.load("images/menu.png")
controls_img = pygame.image.load("images/controls.png")
background_img = pygame.image.load("images/map_background.png")
map_walls_img = pygame.image.load("images/map_walls.png")
heal_img = pygame.image.load("images/heal.png")
pistol_img = pygame.image.load("images/pistol.png")
gun_img = pygame.image.load("images/gun.png")
gameover_img = pygame.image.load("images/gameover.png")
victory_img = pygame.image.load("images/victory.png")

#sprite_groups
all_obstacles = pygame.sprite.Group()
#all_items = pygame.sprite.Group()
HP = pygame.sprite.Group()
EQ = pygame.sprite.Group()
HEAL = pygame.sprite.Group()
PISTOL = pygame.sprite.Group()
GUN = pygame.sprite.Group()
all_bullets = pygame.sprite.Group()
all_enemies = pygame.sprite.Group()
movingsprites = pygame.sprite.Group()
all_sprites = pygame.sprite.Group()

#map
# 0 = no obstacle, X = obstacle, P = pistol, G = gun, E = enemy
X = "X"
H = 'H'
P = "P"
G = "G"
E = "E"
v = np.array([[0, 0, X, 0, 0, X, 0, 0, X, 0, X, 0, 0, X, 0, 0, 0, 0, X, 0, G, X, 0, X, X, X, X, 0, 0, 0, 0, 0],
              [0, 0, X, 0, 0, X, 0, 0, X, 0, X, X, 0, X, X, X, X, 0, X, E, X, X, 0, X, 0, 0, 0, 0, X, X, E, 0],
              [0, X, X, 0, 0, X, 0, 0, 0, 0, 0, 0, E, 0, 0, 0, X, 0, X, 0, E, 0, 0, X, 0, E, X, 0, 0, X, 0, 0],
              [0, 0, 0, 0, 0, X, X, X, X, 0, X, X, 0, X, 0, E, 0, 0, X, X, X, X, 0, X, X, X, X, X, 0, X, E, 0],
              [0, 0, 0, 0, 0, 0, E, 0, X, 0, 0, 0, 0, X, 0, 0, X, 0, 0, 0, 0, 0, 0, X, 0, 0, 0, X, 0, X, 0, 0],
              [X, X, X, X, 0, 0, 0, 0, X, 0, 0, 0, 0, X, 0, 0, X, X, X, X, 0, X, X, X, X, X, 0, X, 0, X, X, 0],
              [0, 0, 0, X, 0, X, X, 0, X, X, X, X, X, X, 0, 0, 0, 0, 0, 0, E, 0, X, 0, 0, X, 0, 0, E, 0, 0, 0],
              [0, 0, 0, X, 0, 0, 0, 0, 0, 0, 0, X, 0, 0, 0, 0, 0, X, 0, 0, 0, 0, X, E, 0, X, X, X, X, X, X, 0],
              [0, H, 0, 0, 0, 0, 0, 0, 0, 0, E, X, X, 0, E, 0, X, X, 0, X, 0, 0, X, 0, 0, X, 0, 0, X, 0, 0, 0],
              [0, 0, E, X, 0, 0, X, X, X, 0, 0, X, X, 0, 0, X, X, 0, 0, X, 0, 0, X, 0, 0, 0, 0, 0, X, 0, E, 0],
              [0, 0, 0, X, 0, 0, X, X, X, 0, 0, X, X, 0, 0, X, 0, 0, X, X, 0, 0, X, 0, 0, X, 0, E, 0, 0, 0, 0],
              [X, X, X, X, 0, 0, 0, 0, 0, 0, 0, X, 0, 0, 0, 0, 0, X, X, 0, 0, 0, X, X, X, X, 0, 0, X, 0, 0, 0],
              [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, X, 0, E, 0, 0, 0, 0, E, 0, X, 0, 0, 0, 0, X, X, X, X],
              [X, 0, X, X, X, 0, X, X, X, X, 0, E, 0, X, X, X, 0, 0, 0, X, 0, 0, 0, 0, 0, X, 0, E, X, X, X, X],
              [X, 0, X, 0, 0, 0, X, 0, E, X, 0, 0, X, X, 0, X, X, X, 0, X, 0, 0, X, X, X, X, 0, 0, X, 0, 0, 0],
              [X, E, X, X, X, X, X, 0, 0, X, 0, 0, X, 0, 0, 0, 0, X, X, X, 0, 0, X, 0, 0, X, E, 0, 0, 0, E, 0],
              [0, 0, P, X, 0, E, 0, 0, 0, X, 0, 0, X, 0, 0, 0, X, X, 0, X, 0, 0, X, 0, 0, 0, 0, 0, X, E, 0, 0],
              [0, X, X, X, 0, 0, X, X, 0, 0, 0, 0, X, 0, X, X, X, 0, 0, X, 0, 0, X, 0, E, 0, 0, 0, X, 0, 0, 0]])


def menu():
    menu = True
    while menu:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                quit()

        clock.tick(15)
        button_start = pygame.draw.rect(screen, GREY, (480, 288, 320, 72))
        button_controls = pygame.draw.rect(screen, GREY, (480, 396, 320, 72))
        button_exit = pygame.draw.rect(screen, GREY, (480, 504, 320, 72))
        screen.blit(menu_img, (0, 0))

        position = pygame.mouse.get_pos()
        click1, click2, click3 = pygame.mouse.get_pressed()

        if button_start.collidepoint(position) and click1:
            menu = False
            clear()
            main()

        if button_controls.collidepoint(position) and click1:
            controls()

        if button_exit.collidepoint(position) and click1:
            quit()

        pygame.display.update()

def clear():
    all_sprites.empty()
    all_enemies.empty()
    EQ.empty()
    HEAL.empty()
    PISTOL.empty()
    GUN.empty()
    all_bullets.empty()
    all_obstacles.empty()
    movingsprites.empty()

def victory():
    victory = True
    while victory:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                quit()

        clock.tick(15)
        screen.blit(victory_img, (0, 0))
        pygame.display.update()
        pygame.time.wait(2500)
        menu()
        victory = False

def game_over():
    game_over = True
    while game_over:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                quit()

        clock.tick(15)
        screen.blit(gameover_img, (0, 0))
        pygame.display.update()
        pygame.time.wait(2500)
        menu()
        game_over = False

def controls():
    controls = True
    while controls:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                quit()

        clock.tick(15)
        screen.blit(controls_img, (420, 232))

        click1, click2, click3 = pygame.mouse.get_pressed()
        key = pygame.key.get_pressed()

        if click1 or key[pygame.K_ESCAPE]:
            controls = False
        pygame.display.update()

def map_background():
    screen.blit(background_img, (0, 0))

def map_walls():
    screen.blit(map_walls_img, (0, 0))

class Obstacle(pygame.sprite.Sprite):
    def __init__(self, x, y, width, height, color):
        super().__init__()
        self.image = pygame.Surface((width, height))
        self.image.fill(color)
        self.rect = self.image.get_rect()
        self.rect.x = x
        self.rect.y = y


class Item(pygame.sprite.Sprite):
    def __init__(self, x, y, width, height, image):
        super().__init__()
        self.image = pygame.Surface((width, height))
        self.rect = self.image.get_rect()
        self.image = image
        self.rect.x = x
        self.rect.y = y

class Enemy(pygame.sprite.Sprite):
    def __init__(self, x, y, width, height, color):
        super().__init__()
        self.image = pygame.Surface((width, height))
        self.rect = self.image.get_rect()
        self.image.fill(color)
        self.rect.x = x
        self.rect.y = y
        self.spawn_x = x + 20
        self.spawn_y = y - 20
        self.speed = 30

    def update(self, *args):
        global player
        choice = random.randint(1, 40)
        if choice == 1:
            self.rect.y -= 20
            if self.rect.y < 0 or abs(self.rect.y - self.spawn_y) > 80:
                self.rect.y += 20
        elif choice == 2:
            self.rect.y += 20
            if self.rect.y > 690 or abs(self.rect.y - self.spawn_y) > 80:
                self.rect.y -= 20
        elif choice == 3:
            self.rect.x -= 20
            if self.rect.x < 0 or abs(self.rect.x - self.spawn_x) > 80:
                self.rect.x += 20
        elif choice == 4:
            self.rect.x += 20
            if self.rect.x > 1250 or abs(self.rect.x - self.spawn_x) > 80:
                self.rect.x -= 20
        else:
            pass

        if player.rect.x < self.rect.x and player.rect.y < self.rect.y and abs(self.rect.x - player.rect.x) < 200 and abs(self.rect.y - player.rect.y) < 200:
            dx = abs(self.rect.x - player.rect.x)
            dy = abs(self.rect.y - player.rect.y)
            distance = math.hypot(dx, dy)
            dx = dx / distance
            dy = dy / distance
            self.rect.x -= dx * self.speed
            self.rect.y -= dy * self.speed

        if player.rect.x > self.rect.x and player.rect.y < self.rect.y and abs(self.rect.x - player.rect.x) < 200 and abs(self.rect.y - player.rect.y) < 200:
            dx = abs(self.rect.x - player.rect.x)
            dy = abs(self.rect.y - player.rect.y)
            distance = math.hypot(dx, dy)
            dx = dx / distance
            dy = dy / distance
            self.rect.x += dx * self.speed
            self.rect.y -= dy * self.speed

        if player.rect.x > self.rect.x and player.rect.y > self.rect.y and abs(self.rect.x - player.rect.x) < 200 and abs(self.rect.y - player.rect.y) < 200:
            dx = abs(self.rect.x - player.rect.x)
            dy = abs(self.rect.y - player.rect.y)
            distance = math.hypot(dx, dy)
            dx = dx / distance
            dy = dy / distance
            self.rect.x += dx * self.speed
            self.rect.y += dy * self.speed

        if player.rect.x < self.rect.x and player.rect.y > self.rect.y and abs(self.rect.x - player.rect.x) < 200 and abs(self.rect.y - player.rect.y) < 200:
            dx = abs(self.rect.x - player.rect.x)
            dy = abs(self.rect.y - player.rect.y)
            distance = math.hypot(dx, dy)
            dx = dx / distance
            dy = dy / distance
            self.rect.x -= dx * self.speed
            self.rect.y += dy * self.speed


def create_map():
    global heal
    global pistol
    global gun
    for i in range(0, 18):
        for j in range(0, 32):
            if v[i][j] == "X":
                new_obstacle = Obstacle((40 * j), (40 * i), 40, 40, GREY)
                all_obstacles.add(new_obstacle)

            elif v[i][j] == "H":
                heal = Item((40 * j), (40 * i), 40, 40, heal_img)
                HEAL.add(heal)
                all_sprites.add(heal)

            elif v[i][j] == "P":
                pistol = Item((40 * j), (40 * i), 40, 40, pistol_img)
                PISTOL.add(pistol)
                all_sprites.add(pistol)

            elif v[i][j] == "G":
                gun = Item((40 * j), (40 * i), 40, 40, gun_img)
                GUN.add(gun)
                all_sprites.add(gun)

            elif v[i][j] == "E":
                new_enemy = Enemy((40 * (j)), (40 * (i)), 40, 40, YELLOW)
                all_enemies.add(new_enemy)
                all_sprites.add(new_enemy)
            else:
                pass


class Player(pygame.sprite.Sprite):
    speed_x = 0
    speed_y = 0
    def __init__(self, x, y):
        super().__init__()
        self.tick1 = pygame.time.get_ticks()
        self.cooldown = 500
        self.image = pygame.Surface([30, 30])
        self.image.fill(BLUE)
        self.rect = self.image.get_rect()
        self.rect.x = x
        self.rect.y = y
        self.health = 99
        self.weapon = 1

    def change_speed(self, x, y):
        self.speed_x += x
        self.speed_y += y

    def move(self, all_obstacles):
        self.rect.x += self.speed_x
        collision_list = pygame.sprite.spritecollide(self, all_obstacles, False)
        for collision in collision_list:
            if self.speed_x > 0:
                self.rect.right = collision.rect.left
            else:
                self.rect.left = collision.rect.right

        self.rect.y += self.speed_y
        collision_list = pygame.sprite.spritecollide(self, all_obstacles, False)
        for collision in collision_list:
            if self.speed_y > 0:
                self.rect.bottom = collision.rect.top
            else:
                self.rect.top = collision.rect.bottom

    def update(self, all_enemies):
        tick2 = pygame.time.get_ticks()
        enemy_collision = pygame.sprite.spritecollide(self, all_enemies, False)
        if enemy_collision and tick2 - self.tick1 >= self.cooldown:
            self.tick1 = tick2
            self.health -= 33
        if enemy_collision and tick2 - self.tick1 >= self.cooldown * 0.1 and self.health == 0:
            pygame.time.delay(500)
            game_over()

        key = pygame.key.get_pressed()
        pickup_heal = pygame.sprite.spritecollide(self, HEAL, False)
        pickup_pistol = pygame.sprite.spritecollide(self, PISTOL, False)
        pickup_gun = pygame.sprite.spritecollide(self, GUN, False)

        if pickup_heal and key[pygame.K_SPACE]:
            HEAL.remove(heal)
            all_sprites.remove(heal)
            EQ.add(heal)
            print('Heal +1!')
        if pickup_pistol and key[pygame.K_SPACE]:
            PISTOL.remove(pistol)
            all_sprites.remove(pistol)
            EQ.add(pistol)
            print('Pistol +1!')
        if pickup_gun and key[pygame.K_SPACE]:
            GUN.remove(gun)
            all_sprites.remove(gun)
            EQ.add(gun)
            print('Gun +1!')

def health_bar(surface, x, y, hp):
    if hp < 0:
        hp = 0
    lenght = 300
    height = 100
    fill = hp * lenght
    outline_rect = pygame.Rect(x, y, lenght, height)
    fill_rect = pygame.Rect(x, y, fill, height)
    fill_rect_background = pygame.Rect(x, y, lenght, height)
    pygame.draw.rect(surface, WHITE, fill_rect_background)
    pygame.draw.rect(surface, RED, fill_rect)
    pygame.draw.rect(surface, WHITE, outline_rect, 2)

class Bullet(pygame.sprite.Sprite):
    def __init__(self, start_x, start_y, destination_x, destination_y, vel):
        super().__init__()
        self.image = pygame.Surface((5, 5))
        self.image.fill(BLACK)
        self.rect = self.image.get_rect()
        self.rect.x = start_x
        self.rect.y = start_y
        self.floating_point_x = start_x
        self.floating_point_y = start_y

        delta_x = destination_x - start_x
        delta_y = destination_y - start_y
        angle = math.atan2(delta_y, delta_x)
        self.change_x = math.cos(angle) * vel
        self.change_y = math.sin(angle) * vel

    def update(self):
        self.floating_point_y += self.change_y
        self.floating_point_x += self.change_x
        self.rect.y = int(self.floating_point_y)
        self.rect.x = int(self.floating_point_x)



def main():
    global player
    global new_enemy
    create_map()
    player = Player(0, 0)
    movingsprites.add(player)

    running = True
    while running == True:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                running = False

            if event.type == pygame.KEYDOWN:
                if event.key == pygame.K_ESCAPE:
                    menu()
                if event.key == pygame.K_q and EQ.has(heal):
                    player.health = 99
                    EQ.remove(heal)

                if event.key == pygame.K_1:
                    player.weapon = 1
                if event.key == pygame.K_2 and EQ.has(pistol):
                    player.weapon = 2
                if event.key == pygame.K_3 and EQ.has(gun):
                    player.weapon = 3

                #player movement
                if event.key == pygame.K_w:
                    player.change_speed(0, -8)
                if event.key == pygame.K_s:
                    player.change_speed(0, 8)
                if event.key == pygame.K_a:
                    player.change_speed(-8, 0)
                if event.key == pygame.K_d:
                    player.change_speed(8, 0)

            if event.type == pygame.KEYUP:
                if event.key == pygame.K_w:
                    player.change_speed(0, 8)
                if event.key == pygame.K_s:
                    player.change_speed(0, -8)
                if event.key == pygame.K_a:
                    player.change_speed(8, 0)
                if event.key == pygame.K_d:
                    player.change_speed(-8, 0)

            if player.weapon == 1 and event.type == pygame.MOUSEBUTTONDOWN:
                position = pygame.mouse.get_pos()
                mouse_x = position[0]
                mouse_y = position[1]
                bullet = Bullet(player.rect.x + 20, player.rect.y + 20, mouse_x, mouse_y, 10)
                all_bullets.add(bullet)
                all_sprites.add(bullet)

            if player.weapon == 2 and event.type == pygame.MOUSEBUTTONDOWN:
                position = pygame.mouse.get_pos()
                mouse_x = position[0]
                mouse_y = position[1]
                bullet = Bullet(player.rect.x + 20, player.rect.y + 20, mouse_x, mouse_y, 15)
                all_bullets.add(bullet)
                all_sprites.add(bullet)

            if player.weapon == 3 and event.type == pygame.MOUSEBUTTONDOWN:
                position = pygame.mouse.get_pos()
                mouse_x = position[0]
                mouse_y = position[1]
                bullet = Bullet(player.rect.x + 20, player.rect.y + 20, mouse_x, mouse_y, 20)
                all_bullets.add(bullet)
                all_sprites.add(bullet)

        for bullet in all_bullets:
            obstacle_hit = pygame.sprite.spritecollide(bullet, all_obstacles, False)
            for new_obstacle in obstacle_hit:
                all_bullets.remove(bullet)
                all_sprites.remove(bullet)

            enemy_hit = pygame.sprite.spritecollide(bullet, all_enemies, True)
            for new_enemy in enemy_hit:
                all_bullets.remove(bullet)
                all_sprites.remove(bullet)

            if bullet.rect.x > 1280:
                all_bullets.remove(bullet)
                all_sprites.remove(bullet)
            if bullet.rect.x < -20:
                all_bullets.remove(bullet)
                all_sprites.remove(bullet)

        player.move(all_obstacles)

        #window collision
        if player.rect.x < 0:
            player.rect.x = 0
        if player.rect.x > 1250:
            player.rect.x = 1250
        if player.rect.y < 0:
            player.rect.y = 0
        if player.rect.y > 690:
            player.rect.y = 690

        clock.tick(15)
        map_background()
        movingsprites.draw(screen)
        all_sprites.update()
        map_walls()
        all_sprites.draw(screen)
        player.update(all_enemies)

        if len(all_enemies) == 0:
            victory()

        health_bar(screen, 490, 620, (player.health / 100))
        pygame.display.flip()

menu()