import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CargoEditor } from './cargo-editor';

describe('CargoEditor', () => {
  let component: CargoEditor;
  let fixture: ComponentFixture<CargoEditor>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CargoEditor]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CargoEditor);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
